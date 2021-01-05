<?php use App\Library\PHPDev\CGlobal; ?>
<?php use App\Library\PHPDev\FuncLib; ?>
<?php use Illuminate\Support\Facades\URL; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Login" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo e(FuncLib::getBaseUrl()); ?>assets/backend/img/favicon.ico" type="image/vnd.microsoft.icon">
    <?php echo CGlobal::$extraMeta; ?>

    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/backend/ace/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/focus/css/reset.css')); ?>" />
    <?php echo CGlobal::$extraHeaderCSS; ?>

    <?php echo CGlobal::$extraHeaderJS; ?>

	<script type="text/javascript">var BASE_URL = "<?php echo e(FuncLib::getBaseUrl()); ?>";</script>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo CGlobal::$extraFooterCSS; ?>

    <?php echo CGlobal::$extraFooterJS; ?>

</body>
</html>
<?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/login/html.blade.php ENDPATH**/ ?>