<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>Custom Page <?php echo e(Auth::guard('custom')->custom()->name); ?></h2>
  <br>
  <a href="/logout">Logout <?php echo e(Auth::guard('custom')->custom()->name); ?> ??</a>
</body>
</html><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\custom.blade.php ENDPATH**/ ?>