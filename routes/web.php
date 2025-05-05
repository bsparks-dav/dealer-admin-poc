<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

    // phpinfo();
    // exit;
    //    $results = DB::connection('sqlsrv4')->select('select top 10 * from DavidsonsReporting.dbo.CPINVHDR');

    // return response()->json($results);
    echo 'DYLD_LIBRARY_PATH='.getenv('DYLD_LIBRARY_PATH').PHP_EOL;

    $serverName = 'dav-sql-2,1433';
    $connectionOptions = [
        'Database' => 'DavidsonsReporting',
        'Uid' => 'webdevs',
        'PWD' => 'AfyOV7PaUNKg1PVt5FtC',
        'Encrypt' => 'no', // set 1 if required
        'TrustServerCertificate' => 'yes',
    ];
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        echo "Could not connect.\n";
        exit(print_r(sqlsrv_errors(), true));
    } else {
        echo "Connected successfully.\n";
    }

});
