<?php

/**
 * Authentication
 */

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost', 'ImageController@resizeImagePost')->name('resizeImagePost');

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

Route::name('js.')->group(function () {
    Route::get('js.dynamic', 'JsController@dynamic')->name('dynamic');
});

// Allow registration routes only if registration is enabled.
if (setting('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (setting('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (setting('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

Route::group(['middleware' => 'auth'], function () {

    /**
     * Impersonate Routes
     */
    Route::impersonate();

    /**
     * Dashboard
     */

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    /**
     * User Profile
     */

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);

    Route::get('profile/activity', [
        'as' => 'profile.activity',
        'uses' => 'ProfileController@activity'
    ]);

    Route::put('profile/details/update', [
        'as' => 'profile.update.details',
        'uses' => 'ProfileController@updateDetails'
    ]);

    Route::post('profile/avatar/update', [
        'as' => 'profile.update.avatar',
        'uses' => 'ProfileController@updateAvatar'
    ]);

    Route::post('profile/avatar/update/external', [
        'as' => 'profile.update.avatar-external',
        'uses' => 'ProfileController@updateAvatarExternal'
    ]);

    Route::put('profile/login-details/update', [
        'as' => 'profile.update.login-details',
        'uses' => 'ProfileController@updateLoginDetails'
    ]);

    /**
     * Two-Factor Authentication Setup
     */

    if (setting('2fa.enabled')) {
        Route::post('two-factor/enable', [
            'as' => 'two-factor.enable',
            'uses' => 'TwoFactorController@enable'
        ]);

        Route::get('two-factor/verification', [
            'as' => 'two-factor.verification',
            'uses' => 'TwoFactorController@verification',
            'middleware' => 'verify-2fa-phone'
        ]);

        Route::post('two-factor/resend', [
            'as' => 'two-factor.resend',
            'uses' => 'TwoFactorController@resend',
            'middleware' => ['throttle:1,1', 'verify-2fa-phone']
        ]);

        Route::post('two-factor/verify', [
            'as' => 'two-factor.verify',
            'uses' => 'TwoFactorController@verify',
            'middleware' => 'verify-2fa-phone'
        ]);

        Route::post('two-factor/disable', [
            'as' => 'two-factor.disable',
            'uses' => 'TwoFactorController@disable'
        ]);
    }

    /**
     * Sessions
     */

    Route::get('profile/sessions', [
        'as' => 'profile.sessions',
        'uses' => 'ProfileController@sessions'
    ]);

    Route::delete('profile/sessions/{session}/invalidate', [
        'as' => 'profile.sessions.invalidate',
        'uses' => 'ProfileController@invalidateSession'
    ]);
    /**
     * Front Page
     */
    Route::get('home', [
        'as' => 'home.list',
        'uses' => 'HomeController@index'
    ]);

    /**
     * Content Management
     */
    Route::get('content', [
        'as' => 'content.list',
        'uses' => 'ContentController@index'
    ]);

    Route::get('content/create', [
        'as' => 'content.create',
        'uses' => 'ContentController@create'
    ]);

    Route::post('content/store', [
        'as' => 'content.store',
        'uses' => 'ContentController@store'
    ]);

     /**
     * Laboratory Management
     */
    Route::get('laboratory', [
        'as' => 'laboratory.list',
        'uses' => 'LaboratoryController@index'
    ]);

     /**
     * ACTMS
     */
    Route::get('registration', [
        'as' => 'registration.list',
        'uses' => 'RegistrationController@index'
    ]);

    Route::get('validation', [
        'as' => 'validation.list',
        'uses' => 'RegistrationController@validationlist'
    ]);

    Route::get('approval', [
        'as' => 'approval.list',
        'uses' => 'RegistrationController@approvallist'
    ]);

    Route::get('reporting', [
        'as' => 'reporting.list',
        'uses' => 'RegistrationController@reporting'
    ]);

    /**
     * Customer Interfaces
     */
    Route::get('customer_sas', [
        'as' => 'customer_sas.list',
        'uses' => 'CustomerController@index'
    ]);

    Route::get('customer_invoice', [
        'as' => 'customer_invoice.list',
        'uses' => 'CustomerController@customer_invoice_list'
    ]);

    Route::get('customer_spec', [
        'as' => 'customer_spec.list',
        'uses' => 'CustomerController@customer_spec_list'
    ]);

    Route::get('customer_cer', [
        'as' => 'customer_cer.list',
        'uses' => 'CustomerController@customer_cer_list'
    ]);


      /**
     * Laboratory Instruments
     */
    Route::get('lab_instrument', [
        'as' => 'lab_instrument.list',
        'uses' => 'LabInstrumentController@index'
    ]);

          /**
     * Data Analysis / Visualization
     */
    Route::get('data_analysis', [
        'as' => 'data_analysis.list',
        'uses' => 'DataAnalysisController@index'
    ]);

          /**
     * Tender Monitoring System
     */
    Route::get('tender', [
        'as' => 'tender.list',
        'uses' => 'TenderController@index'
    ]);

          /**
     * Inventory
     */
    Route::get('inventory', [
        'as' => 'inventory.list',
        'uses' => 'InventoryController@index'
    ]);

          /**
     * Document Controlled / COA / Calibration Certificate
     */
    Route::get('document', [
        'as' => 'document.list',
        'uses' => 'DocumentController@index'
    ]);

    /**
     * Certificate Library
     */
    Route::get('certificate', [
        'as' => 'certificate.list',
        'uses' => 'CertificateController@index'
    ]);

    /**
     * Outside Services - Sampling 
     */
    Route::get('sampling', [
        'as' => 'sampling.list',
        'uses' => 'SamplingController@index'
    ]);

    /**
     * Outside Services - Filtration 
     */
    Route::get('filtration', [
        'as' => 'filtration.list',
        'uses' => 'FiltrationController@index'
    ]);

    /**
     * Product Commercialization - Etods Sampling Kit
     */
    Route::get('product-etods-kit', [
        'as' => 'product-etods-kit.list',
        'uses' => 'ProductEtodsKitController@index'
    ]);

    /**
     * Product Commercialization - Rubber Adaptor
     */
    Route::get('product-rubber-adaptor', [
        'as' => 'product-rubber-adaptor.list',
        'uses' => 'ProductRubberAdaptorController@index'
    ]);

    /**
     * Quality Control
     */
    Route::get('quality-control', [
        'as' => 'quality-control.list',
        'uses' => 'QCController@index'
    ]);

    /**
     * Quality Assurance
     */
    Route::get('quality-assurance', [
        'as' => 'quality-assurance.list',
        'uses' => 'QAController@index'
    ]);

    /**
     * Financial Management
     */
    Route::get('financial', [
        'as' => 'financial.list',
        'uses' => 'FinancialController@index'
    ]);

    /**
     * Staff Training - Training Record
     */
    Route::get('training-record', [
        'as' => 'training-record.list',
        'uses' => 'TrainingRecordController@index'
    ]);

    /**
     * Staff Training - Training Supplier Record
     */
    Route::get('training-supplier-record', [
        'as' => 'training-supplier-record.list',
        'uses' => 'TrainingSupplierRecordController@index'
    ]);

    /**
     * Staff Training - CSI Record
     */
    Route::get('csi-record', [
        'as' => 'csi-record.list',
        'uses' => 'CSIRecordController@index'
    ]);

    /**
     * Waste Management - Schedule
     */
    Route::get('waste-record', [
        'as' => 'waste-record.list',
        'uses' => 'WasteController@index'
    ]);

    /**
     * Waste Management - Supplier Record
     */
    Route::get('waste-supplier-record', [
        'as' => 'waste-supplier-record.list',
        'uses' => 'WasteSupplierController@index'
    ]);

    /**
     * Staff Performance
     */
    Route::get('staff-performance', [
        'as' => 'staff-performance.list',
        'uses' => 'StaffPerformanceController@index'
    ]);

    /**
     * User Management
     */
    Route::get('user', [
        'as' => 'user.list',
        'uses' => 'UsersController@index'
    ]);

    Route::get('user/create', [
        'as' => 'user.create',
        'uses' => 'UsersController@create'
    ]);

    Route::post('user/create', [
        'as' => 'user.store',
        'uses' => 'UsersController@store'
    ]);

    Route::get('user/{user}/show', [
        'as' => 'user.show',
        'uses' => 'UsersController@view'
    ]);

    Route::get('user/{user}/edit', [
        'as' => 'user.edit',
        'uses' => 'UsersController@edit'
    ]);

    Route::put('user/{user}/update/details', [
        'as' => 'user.update.details',
        'uses' => 'UsersController@updateDetails'
    ]);

    Route::put('user/{user}/update/login-details', [
        'as' => 'user.update.login-details',
        'uses' => 'UsersController@updateLoginDetails'
    ]);

    Route::delete('user/{user}/delete', [
        'as' => 'user.delete',
        'uses' => 'UsersController@delete'
    ]);

    Route::post('user/{user}/update/avatar', [
        'as' => 'user.update.avatar',
        'uses' => 'UsersController@updateAvatar'
    ]);

    Route::post('user/{user}/update/avatar/external', [
        'as' => 'user.update.avatar.external',
        'uses' => 'UsersController@updateAvatarExternal'
    ]);

    Route::get('user/{user}/sessions', [
        'as' => 'user.sessions',
        'uses' => 'UsersController@sessions'
    ]);

    Route::delete('user/{user}/sessions/{session}/invalidate', [
        'as' => 'user.sessions.invalidate',
        'uses' => 'UsersController@invalidateSession'
    ]);

    Route::post('user/{user}/two-factor/enable', [
        'as' => 'user.two-factor.enable',
        'uses' => 'UsersController@enableTwoFactorAuth'
    ]);

    Route::post('user/{user}/two-factor/disable', [
        'as' => 'user.two-factor.disable',
        'uses' => 'UsersController@disableTwoFactorAuth'
    ]);

    /**
     * Roles & Permissions
     */

    Route::get('role', [
        'as' => 'role.index',
        'uses' => 'RolesController@index'
    ]);

    Route::get('role/create', [
        'as' => 'role.create',
        'uses' => 'RolesController@create'
    ]);

    Route::post('role/store', [
        'as' => 'role.store',
        'uses' => 'RolesController@store'
    ]);

    Route::get('role/{role}/edit', [
        'as' => 'role.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('role/{role}/update', [
        'as' => 'role.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('role/{role}/delete', [
        'as' => 'role.delete',
        'uses' => 'RolesController@delete'
    ]);


    Route::post('permission/save', [
        'as' => 'permission.save',
        'uses' => 'PermissionsController@saveRolePermissions'
    ]);

    Route::resource('permission', 'PermissionsController');

    /**
     * Settings
     */

    Route::get('settings', [
        'as' => 'settings.general',
        'uses' => 'SettingsController@general',
        'middleware' => 'permission:settings.general'
    ]);

    Route::post('settings/general', [
        'as' => 'settings.general.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.general'
    ]);

    Route::get('settings/auth', [
        'as' => 'settings.auth',
        'uses' => 'SettingsController@auth',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth', [
        'as' => 'settings.auth.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.auth'
    ]);

    // Only allow managing 2FA if AUTHY_KEY is defined inside .env file
    if (env('AUTHY_KEY')) {
        Route::post('settings/auth/2fa/enable', [
            'as' => 'settings.auth.2fa.enable',
            'uses' => 'SettingsController@enableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);

        Route::post('settings/auth/2fa/disable', [
            'as' => 'settings.auth.2fa.disable',
            'uses' => 'SettingsController@disableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);
    }

    Route::post('settings/auth/registration/captcha/enable', [
        'as' => 'settings.registration.captcha.enable',
        'uses' => 'SettingsController@enableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/registration/captcha/disable', [
        'as' => 'settings.registration.captcha.disable',
        'uses' => 'SettingsController@disableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::get('settings/notifications', [
        'as' => 'settings.notifications',
        'uses' => 'SettingsController@notifications',
        'middleware' => 'permission:settings.notifications'
    ]);

    Route::post('settings/notifications', [
        'as' => 'settings.notifications.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.notifications'
    ]);

    /**
     * Activity Log
     */

    Route::get('activity', [
        'as' => 'activity.index',
        'uses' => 'ActivityController@index'
    ]);

    Route::get('activity/user/{user}/log', [
        'as' => 'activity.user',
        'uses' => 'ActivityController@userActivity'
    ]);

    /**
     * Developer Tools
     */
    Route::get('developer', [
        'as' => 'developer.index',
        'uses' => 'DeveloperController@index',
        'middleware' => 'permission:developer.tools'
    ]);

    Route::get('developer/optimize', [
        'as' => 'developer.optimize',
        'uses' => 'DeveloperController@optimize',
        'middleware' => 'permission:developer.tools'
    ]);

    Route::get('developer/migrate', [
        'as' => 'developer.migrate',
        'uses' => 'DeveloperController@migrate',
        'middleware' => 'permission:developer.tools'
    ]);

    Route::get('developer/rollback', [
        'as' => 'developer.rollback',
        'uses' => 'DeveloperController@rollback',
        'middleware' => 'permission:developer.tools'
    ]);
});


/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);

$router->get('file_application/index', [
    'as' => 'file_application.index',
    'uses' => 'FileApplicationController@index'
]);

$router->get('file_application/show/{file_application}', [
    'as' => 'file_application.show',
    'uses' => 'FileApplicationController@show'
]);

$router->get('file_application/create', [
    'as' => 'file_application.create',
    'uses' => 'FileApplicationController@create'
]);

$router->get('file_application/edit/{file_application}', [
    'as' => 'file_application.edit',
    'uses' => 'FileApplicationController@edit'
]);

$router->put('file_application/update/{file_application}', [
    'as' => 'file_application.update',
    'uses' => 'FileApplicationController@update'
]);

$router->delete('file_application/delete/{file_application}', [
    'as' => 'file_application.delete',
    'uses' => 'FileApplicationController@destroy'
]);

$router->get('file_application/approve/{file_application}', [
    'as' => 'file_application.approve',
    'uses' => 'FileApplicationController@approveForm'
]);

$router->put('file_application/approve/{file_application}', [
    'as' => 'file_application.approve',
    'uses' => 'FileApplicationController@approve'
]);