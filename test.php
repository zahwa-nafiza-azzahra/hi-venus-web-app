<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = App\Models\User::where('role', 'cashier')->first();
if (!$user) {
    echo "No cashier user found\n";
    exit;
}

$request = Illuminate\Http\Request::create('/cashier/report/pdf', 'GET');
$request->setUserResolver(function () use ($user) {
    return $user;
});
// also set session and auth
$app->make('auth')->login($user);

$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() != 200) {
    echo "Content: " . substr($response->getContent(), 0, 500) . "\n";
} else {
    echo "Headers: \n";
    foreach ($response->headers->all() as $k => $v) {
        echo "$k: " . implode(', ', $v) . "\n";
    }
}
