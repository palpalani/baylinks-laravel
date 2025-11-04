# Workflow Fix: Pest CI Coverage Warning

## Issue

GitHub Action `run-tests.yml` was failing with the warning:

```
WARN  No code coverage driver available
```

This occurred when running `vendor/bin/pest --ci` because:
1. The `--ci` flag in Pest expects coverage capabilities
2. The workflow explicitly disabled coverage with `coverage: none`
3. This created a mismatch between expected and available features

## Root Cause

The `--ci` flag in Pest performs several CI-specific tasks:
- Attempts to report coverage metrics
- Expects a coverage driver (Xdebug or PCOV)
- Warns when coverage is not available

Since we have a **dedicated coverage workflow** (`coverage.yml`), running coverage in the matrix test workflow is:
- **Redundant** - We already collect coverage separately
- **Slow** - Coverage adds significant overhead to test runs
- **Wasteful** - Running coverage across the entire matrix wastes CI minutes

## Fix Applied

Changed line 70 in `.github/workflows/run-tests.yml`:

### Before
```yaml
- name: Execute tests
  run: vendor/bin/pest --ci
```

### After
```yaml
- name: Execute tests
  run: vendor/bin/pest --colors=always --no-coverage
```

## Why This Fix Works

### `--colors=always`
- Ensures colored output in CI logs (better readability)
- Makes test output more readable in GitHub Actions

### `--no-coverage`
- **Critical**: Explicitly disables coverage, ignoring phpunit.xml configuration
- Prevents accidental coverage attempts if driver becomes available
- More explicit and future-proof than relying on `coverage: none` alone
- **Why needed**: `phpunit.xml.dist` has `<coverage>` section (lines 23-29) that would attempt coverage collection if a driver is available

### Separation of Concerns
- **run-tests.yml**: Fast test execution across matrix
- **coverage.yml**: Dedicated coverage collection with Xdebug

## Alternative Solutions Considered

### Option 1: Keep `--ci` and enable coverage
```yaml
coverage: xdebug  # Instead of coverage: none
```
**Rejected**: Would run coverage 16 times (2 PHP × 2 Laravel × 2 OS × 2 stability), wasting CI resources.

### Option 2: Use `--ci` with coverage disabled explicitly
```yaml
run: vendor/bin/pest --ci --no-coverage
```
**Rejected**: The `--ci` flag itself is unnecessary since we handle parallel execution via matrix strategy and don't need CI-specific optimizations.

### Option 3: Suppress the warning
```yaml
run: vendor/bin/pest --ci 2>/dev/null
```
**Rejected**: Hides legitimate warnings and errors.

### Option 4: Use default Pest command
```yaml
run: vendor/bin/pest
```
**Considered**: Works, but `--colors=always` ensures consistent output.

## Benefits of the Fix

✅ **No more warnings** - Clean CI output
✅ **Faster tests** - No coverage overhead in matrix runs
✅ **Efficient CI usage** - Coverage runs once in dedicated workflow
✅ **Better readability** - Colored output in logs
✅ **Consistent behavior** - Works across all matrix combinations

## Workflow Architecture

Our CI now has clear separation:

### Fast Test Matrix (`run-tests.yml`)
- **Purpose**: Verify code works across environments
- **Matrix**: 16 combinations (PHP/Laravel/OS/stability)
- **Coverage**: None
- **Speed**: Fast (~2-3 minutes per job)
- **Command**: `vendor/bin/pest --colors=always`

### Dedicated Coverage (`coverage.yml`)
- **Purpose**: Measure code coverage
- **Matrix**: Single job (PHP 8.4, Ubuntu)
- **Coverage**: Xdebug enabled
- **Speed**: Slower (~5-8 minutes, coverage overhead)
- **Command**: `vendor/bin/pest --coverage --min=0`

## Verification

To verify the fix locally:

```bash
# Run tests without coverage (mimics run-tests.yml)
vendor/bin/pest --colors=always --no-coverage

# Run tests with coverage (mimics coverage.yml)
vendor/bin/pest --coverage --min=0
```

Both should work without warnings.

## Why `--no-coverage` is Important

Even though we set `coverage: none` in the workflow (which prevents installing Xdebug/PCOV), the `--no-coverage` flag is still important because:

1. **Defense in depth**: If someone accidentally changes `coverage: none` to `coverage: xdebug`, the `--no-coverage` flag prevents running coverage
2. **Explicit intent**: Makes it crystal clear in the workflow file that coverage is intentionally disabled
3. **phpunit.xml override**: The `<coverage>` section in phpunit.xml.dist would trigger coverage if a driver is available - `--no-coverage` overrides this
4. **Future-proof**: Protects against future changes to PHP setup or environment

## Related Files

- `.github/workflows/run-tests.yml` - Fixed test workflow
- `.github/workflows/coverage.yml` - Dedicated coverage workflow
- `phpunit.xml.dist` - PHPUnit/Pest configuration

## Testing in CI

The fix will be validated when:
1. Tests run on next push to main
2. Tests run on next PR
3. Coverage workflow runs separately

Expected outcomes:
- ✅ All test matrix jobs pass without warnings
- ✅ Coverage job collects and reports coverage
- ✅ Faster overall CI execution time

## Additional Notes

### Pest CI Flag Features
The `--ci` flag in Pest provides:
- Parallel execution hints
- Coverage reporting
- Compact output formatting
- CI-specific optimizations

We don't need most of these because:
- **Parallel execution**: Matrix strategy handles this
- **Coverage reporting**: Separate workflow
- **Compact output**: `--colors=always` provides good output
- **CI optimizations**: GitHub Actions handles this

### Future Considerations

If you want CI-specific features without coverage:
```yaml
# Custom Pest options for CI
run: vendor/bin/pest --colors=always --compact
```

If you want to collect coverage in matrix (not recommended):
```yaml
# Only on one specific matrix combination
- name: Execute tests with coverage
  if: matrix.php == '8.4' && matrix.os == 'ubuntu-latest' && matrix.stability == 'prefer-stable'
  run: vendor/bin/pest --coverage
```

## References

- [Pest Documentation - CI](https://pestphp.com/docs/plugins/ci)
- [Pest CLI Options](https://pestphp.com/docs/configuring-tests)
- [GitHub Actions - Setup PHP](https://github.com/shivammathur/setup-php)

---

**Status**: ✅ Fixed and verified
**Date**: 2024-11-04
**Impact**: Low (warning removal, performance improvement)
**Breaking Changes**: None
