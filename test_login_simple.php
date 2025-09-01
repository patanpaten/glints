<!DOCTYPE html>
<html>
<head>
    <title>Test Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Test Login Form</h2>
    
    <?php if(isset($_GET['result'])): ?>
        <div style="padding: 10px; margin: 10px 0; border: 1px solid #ccc; background: #f9f9f9;">
            <strong>Login Result:</strong> <?= htmlspecialchars($_GET['result']) ?>
        </div>
    <?php endif; ?>
    
    <form action="/login" method="POST">
        <input type="hidden" name="_token" value="test-token">
        
        <div style="margin: 10px 0;">
            <label>Email:</label><br>
            <input type="email" name="email" value="hans@gmail.com" required style="width: 300px; padding: 5px;">
        </div>
        
        <div style="margin: 10px 0;">
            <label>Password:</label><br>
            <input type="password" name="password" value="password" required style="width: 300px; padding: 5px;">
        </div>
        
        <div style="margin: 10px 0;">
            <label>
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
        </div>
        
        <div style="margin: 10px 0;">
            <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">Login</button>
        </div>
    </form>
    
    <hr>
    
    <h3>Quick Links for Testing:</h3>
    <ul>
        <li><a href="/login-email">Login Page</a></li>
        <li><a href="/jobseeker/dashboard">Jobseeker Dashboard (requires auth)</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
    
    <h3>Debug Info:</h3>
    <ul>
        <li>Current URL: <?= $_SERVER['REQUEST_URI'] ?? 'N/A' ?></li>
        <li>Server Time: <?= date('Y-m-d H:i:s') ?></li>
    </ul>
</body>
</html>