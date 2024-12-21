<br>
<nav class="shadow p-3 mb-5 bg-body rounded navbar navbar-expand navbar-light bg-light container">

    <ul class="navbar-nav">
        <li class="navitem  navbar-nav nav-link activs img-responsive"><a href="index.php">
                <img data-bs-toggle=" tooltip" data-bs-placement="bottom" data-bs-html="true" title="Home" src="logo.png" alt=""></a></li>
        <li class="navitem"><a href="index.php" class="nav-link activs <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ?  "activ" :  ''; ?>">Radovi</a></li>
        <li class="navitem"><a href="index.html" class="nav-link activs">Prekidi</a></li>
        <li class="navitem"><a href="nodovi.html" class="nav-link activs">Nodovi</a></li>
        <li class="navitem"><a href="snr.php" class="nav-link activs <?php echo basename($_SERVER['PHP_SELF']) === 'snr.php' ?  "activ" :  ''; ?>">Snr</a></li>

    </ul>
</nav>