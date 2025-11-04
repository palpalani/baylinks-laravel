# GitHub Workflows Quick Reference

## 📋 Workflow Overview

| Workflow | Purpose | Trigger | Status |
|----------|---------|---------|--------|
| **run-tests.yml** | Run test suite across PHP/Laravel matrix | Push (main), PR | ✅ Enhanced |
| **phpstan.yml** | Static analysis with PHPStan | Push (main), PR | ✅ Enhanced |
| **coverage.yml** | Code coverage tracking | Push (main), PR | ✅ New |
| **security.yml** | Security scanning & SBOM | Push, PR, Weekly | ✅ New |
| **pr-quality.yml** | PR quality checks | PR only | ✅ New |
| **fix-php-code-style-issues.yml** | Auto-fix code style | Push (branches) | ✅ Enhanced |
| **dependabot-auto-merge.yml** | Auto-merge dependencies | Dependabot PRs | ✅ Enhanced |
| **release.yml** | Automated releases | Tag push | ✅ New |
| **benchmark.yml** | Performance benchmarks | Push, PR, Manual | ✅ New |
| **update-changelog.yml** | Update changelog on release | Release created | ✅ Existing |

---

## 🚀 Quick Commands

### Run Workflows Locally (Testing)

```bash
# Install act (GitHub Actions local runner)
brew install act  # macOS
# or
curl https://raw.githubusercontent.com/nektos/act/master/install.sh | sudo bash  # Linux

# List all workflows
act -l

# Run a specific workflow
act push -W .github/workflows/run-tests.yml

# Run with secrets
act -s GITHUB_TOKEN=your_token
```

### Common Development Tasks

```bash
# Before committing
composer format              # Fix code style
composer analyse             # Run PHPStan
composer test                # Run tests
composer test-coverage       # Check coverage

# Check what workflows will run
gh workflow list             # List all workflows
gh run list                  # List recent runs
gh run view <run-id>         # View specific run
```

---

## 🔍 Workflow Details

### 1. run-tests.yml
**What it does**: Runs Pest tests across multiple PHP/Laravel/OS combinations

**Matrix**:
- PHP: 8.3, 8.4
- Laravel: 11.x, 12.x
- OS: Ubuntu, Windows
- Stability: prefer-lowest, prefer-stable

**When it runs**: Every push to main, every PR

**Enhancements**:
- ✅ Composer caching (30-60% faster)
- ✅ Concurrency control
- ✅ Fixed carbon dependency bug

---

### 2. phpstan.yml
**What it does**: Static analysis at level 4

**When it runs**: Push to main, PRs (PHP file changes)

**Enhancements**:
- ✅ Now runs on PRs (was push-only)
- ✅ Composer caching
- ✅ Concurrency control

**Local equivalent**:
```bash
composer analyse
```

---

### 3. coverage.yml
**What it does**: Measures test coverage, uploads to Codecov

**When it runs**: Push to main, every PR

**Features**:
- Uses Xdebug for coverage
- Uploads to Codecov (optional)
- Generates clover XML report

**Setup Codecov**:
1. Sign up at https://codecov.io
2. Add `CODECOV_TOKEN` to GitHub secrets
3. Coverage will auto-upload

**Local equivalent**:
```bash
composer test-coverage
```

---

### 4. security.yml
**What it does**: Security scanning and compliance

**Jobs**:
- **composer-audit**: Scans for vulnerable dependencies
- **dependency-review**: PR dependency changes review
- **sbom**: Generates Software Bill of Materials

**When it runs**:
- Push to main
- Every PR
- Weekly (Monday 00:00 UTC)

**Features**:
- Blocks PRs with moderate+ vulnerabilities
- License compliance (blocks GPL-3.0, AGPL-3.0)
- SBOM artifacts for supply chain security

**Local equivalent**:
```bash
composer audit
```

---

### 5. pr-quality.yml
**What it does**: Automated code quality checks for PRs

**Checks**:
- ✅ Validates composer.json/lock
- ✅ Finds debug statements (dd, dump, var_dump)
- ✅ Scans for TODO/FIXME
- ✅ Checks file permissions
- ✅ PR size warnings
- ✅ Conventional commit format
- ✅ Changelog update reminder

**When it runs**: Every PR (opened, updated)

**All checks are non-blocking** - they warn/notice only

---

### 6. fix-php-code-style-issues.yml
**What it does**: Automatically fixes code style with Laravel Pint

**When it runs**: Push to any branch (except main)

**Behavior**:
- Runs Laravel Pint
- Auto-commits fixes
- Uses conventional commit message

**Enhancements**:
- ✅ Skips main branch (safer)
- ✅ Concurrency control
- ✅ Better commit attribution

**Note**: Won't run on main to prevent conflicts

---

### 7. dependabot-auto-merge.yml
**What it does**: Automatically merges safe dependency updates

**Behavior**:
- **Patch/Minor**: Auto-approves & merges
- **Major**: Comments warning, adds labels, requires manual review

**When it runs**: On Dependabot PRs only

**Enhancements**:
- ✅ Auto-approval before merge
- ✅ Detailed comments on major updates
- ✅ Adds 'major-update' & 'needs-review' labels
- ✅ Uses squash commits

**Safety**: Only merges after all checks pass

---

### 8. release.yml
**What it does**: Automated release creation from tags

**Workflow**:
1. Validates tag format (v1.2.3)
2. Generates changelog
3. Creates GitHub release
4. Comments on related PRs
5. Provides installation instructions

**Trigger**:
```bash
git tag v1.0.0
git push origin v1.0.0
```

**Features**:
- Auto-detects pre-releases (alpha, beta, rc)
- Compares with composer.json version
- Beautiful release notes
- PR notifications

---

### 9. benchmark.yml
**What it does**: Performance monitoring and benchmarks

**Metrics**:
- Composer autoload time
- Memory usage
- Class loading performance
- Project statistics
- PR performance comparison

**When it runs**: Push to main, PRs, manual trigger

**Future**: Placeholder for PHPBench integration

**Manual trigger**:
```bash
gh workflow run benchmark.yml
```

---

### 10. update-changelog.yml
**What it does**: Updates CHANGELOG.md on release

**When it runs**: When a GitHub release is created

**Behavior**:
- Extracts release notes
- Updates CHANGELOG.md
- Commits to main branch

---

## 📊 Workflow Status Badges

Add to your README:

```markdown
<!-- Core Quality -->
[![Tests](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Arun-tests)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3Aphpstan)
[![Coverage](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/coverage.yml?branch=main&label=coverage&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Code+Coverage")

<!-- Security -->
[![Security](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/security.yml?branch=main&label=security&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions?query=workflow%3A"Security+Scan")

<!-- Code Quality -->
[![Code Style](https://img.shields.io/github/actions/workflow/status/palpalani/baylinks-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/palpalani/baylinks-laravel/actions)
```

---

## 🔧 Configuration Files

| File | Purpose |
|------|---------|
| `.commitlintrc.json` | Conventional commit rules |
| `.github/dependabot.yml` | Dependency update config |
| `.github/workflows/*.yml` | Workflow definitions |

---

## 🚨 Common Issues & Fixes

### Issue: Workflow not running
**Fix**: Check trigger conditions in workflow file

### Issue: Tests failing in CI but passing locally
**Fix**: Check PHP version, dependency versions, environment

### Issue: Dependabot not auto-merging
**Fix**:
1. Check branch protection rules
2. Verify all required checks pass
3. Enable auto-merge in repo settings

### Issue: Coverage not uploading to Codecov
**Fix**: Add `CODECOV_TOKEN` to GitHub secrets

### Issue: Security scan false positives
**Fix**: Review and suppress in workflow if needed

---

## 📚 Resources

- [GitHub Actions Docs](https://docs.github.com/en/actions)
- [Workflow Syntax](https://docs.github.com/en/actions/using-workflows/workflow-syntax-for-github-actions)
- [Dependabot Config](https://docs.github.com/en/code-security/dependabot/dependabot-version-updates/configuration-options-for-the-dependabot.yml-file)
- [Conventional Commits](https://www.conventionalcommits.org/)

---

## 💡 Pro Tips

1. **Use concurrency groups** - Prevents redundant runs
2. **Cache dependencies** - Saves time and money
3. **Use matrix builds wisely** - Test critical combinations only
4. **Set up branch protection** - Require status checks before merge
5. **Monitor workflow run times** - Optimize slow steps
6. **Use `continue-on-error`** - For non-critical checks
7. **Add manual triggers** - For debugging: `workflow_dispatch`

---

## 📞 Need Help?

- Check `.github/IMPLEMENTATION_SUMMARY.md` for detailed implementation guide
- Check `.github/WORKFLOW_RECOMMENDATIONS.md` for analysis and rationale
- Check GitHub Actions tab for run details
- Open an issue for workflow-related problems
