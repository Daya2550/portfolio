# Admin Page Troubleshooting Guide

## Common Issues and Solutions

### 1. Admin Page Not Loading (Blank/White Screen)

**Possible Causes:**
- PHP errors not being displayed
- Database connection issues
- Missing files or incorrect file paths
- Server configuration problems

**Solutions:**

#### Step 1: Run Debug Tests
1. First, visit `admin-debug.php` in your browser
2. This will test each component individually and show you exactly what's working and what's not

#### Step 2: Try Simple Admin
1. If the main admin.php fails, try `admin-simple.php`
2. This is a simplified version that should work even with basic hosting

#### Step 3: Setup Database
1. Run `setup-database.php` to ensure all required tables exist
2. This will create any missing database tables

### 2. Database Connection Issues

**Check these settings in `includes/config.php`:**
```php
$host = 'sql100.infinityfree.com';  // Your database host
$db   = 'if0_39432401_protfolio';   // Your database name
$user = 'if0_39432401';             // Your database username
$pass = 'gGgd1nzsa9';               // Your database password
```

**Common fixes:**
- Verify credentials are correct
- Check if database exists on your hosting panel
- Ensure database user has proper permissions

### 2.1. Column Not Found Error (SQLSTATE[42S22])

**Error:** `SQLSTATE[42S22]: Column not found: 1054 Unknown column 'course' in 'INSERT INTO'`

**Cause:** Your database tables are missing required columns.

**Solution:**
1. **Run the database repair script:** Visit `fix-database.php` in your browser
2. This will check and add any missing columns to your tables
3. **Alternative:** Run `setup-database.php` to recreate all tables

**Manual fix (if scripts don't work):**
```sql
ALTER TABLE basic_details ADD COLUMN course VARCHAR(100) DEFAULT NULL;
ALTER TABLE basic_details ADD COLUMN gender VARCHAR(20) DEFAULT NULL;
ALTER TABLE basic_details ADD COLUMN birth_date DATE DEFAULT NULL;
ALTER TABLE basic_details ADD COLUMN languages VARCHAR(255) DEFAULT NULL;
ALTER TABLE basic_details ADD COLUMN profile_photo VARCHAR(255) DEFAULT NULL;
```

### 3. File Permission Issues

**Check these directories exist and are writable:**
- `uploads/` (for file uploads)
- `uploads/cv/` (for CV files)
- `uploads/projects/` (for project images)

**Fix permissions:**
- Set directories to 755 or 777 if needed
- Ensure PHP can write to these directories

### 4. PHP Version Issues

**Requirements:**
- PHP 7.4 or higher recommended
- PDO extension enabled
- File upload enabled

### 5. Hosting-Specific Issues

**For InfinityFree hosting:**
- Some features may be limited on free hosting
- File upload limits may apply
- Database connections may have timeouts

## Step-by-Step Troubleshooting

### Step 1: Basic Connectivity
1. Visit `admin-debug.php`
2. Check if all green checkmarks appear
3. Note any red X marks or warnings

### Step 2: Database Setup
1. Visit `setup-database.php`
2. Ensure all tables are created successfully
3. Check for any error messages

### Step 3: Simple Admin Test
1. Visit `admin-simple.php`
2. Try adding some basic information
3. Check if data saves successfully

### Step 4: Full Admin Panel
1. Only after steps 1-3 work, try `admin.php`
2. If it still doesn't work, check error logs

## Error Log Locations

**Common locations:**
- `error.log` (in your website root)
- `error_log` (in your website root)
- Check your hosting control panel for error logs

## Configuration Changes Made

### 1. Error Reporting
- Disabled error display for production
- Enabled error logging instead
- Added development mode toggle

### 2. Database Connection
- Added connection testing
- Improved error handling
- Added fallback error messages

### 3. File Structure
- Added error handling for missing files
- Improved session management
- Added data retrieval error handling

## Files Created for Troubleshooting

1. **admin-debug.php** - Comprehensive testing tool
2. **admin-simple.php** - Simplified admin interface
3. **setup-database.php** - Database table creation
4. **TROUBLESHOOTING.md** - This guide

## Quick Fix Checklist

- [ ] Database credentials are correct
- [ ] All required files exist
- [ ] Upload directories are writable
- [ ] PHP version is compatible
- [ ] Database tables exist
- [ ] Error logs checked

## Contact Information

If you continue having issues:
1. Check the error logs first
2. Run all debug tools
3. Note exactly what error messages you see
4. Check your hosting provider's documentation

## Next Steps

1. Start with `admin-debug.php`
2. Fix any issues it identifies
3. Run `setup-database.php`
4. Test with `admin-simple.php`
5. Finally try the full `admin.php`
