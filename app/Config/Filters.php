<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'filterketua'   => \App\Filters\FilterKetua::class,
        'filterbendahara'   => \App\Filters\FilterBendahara::class,
        'filtersekretaris'  => \App\Filters\FilterSekretaris::class,
        'filteranggota' => \App\Filters\FilterAnggota::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filterketua'=>[
                'except' => [
                    'home','home/*',
                    'auth','auth/*',
                    '/',
                ]],
            'filterbendahara'=>[
                'except' => [
                    'home','home/*',
                    'auth','auth/*',
                    '/',
                ]],
            'filtersekretaris'=>[
                'except' => [
                    'home','home/*',
                    'auth','auth/*',
                    '/',
                ]],
            'filteranggota'=>[
                'except' => [
                    'home','home/*',
                    'auth','auth/*',
                    '/',

            // ]],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ]]],

        'after' => [
            'filterketua'=>[
                'except' => [
                    'home','home/*',
                    '/',
                    'ketua','ketua/*',          
                    'petugas','petugas/*',
                    'berita','berita/*',
                ]
            ],
            'filterbendahara'=>[
                'except' => [
                    'home','home/*',
                    '/',
                    'bendahara','bendahara/*',
                    'petugas','petugas/*',
                    'kas','kas/*',
                ]
            ],
            'filtersekretaris'=>[
                'except' => [
                    'home','home/*',
                    '/',
                    'anggota','anggota/*',
                    'sekretaris','sekretaris/*',
                    'petugas','petugas/*',
                    // 'pinjaman/jenisPinjaman',
                    // 'pinjaman/jnsPinjamCreate',
                    // 'petugas/daftarPengajuanPinjaman',
                    // 'petugas/prosesTolakPinjaman',
                ]
            ],
            'filteranggota'=>[
                'except' => [
                    'home','home/*',
                    '/',
                    // 'simpanan/*',
                    // 'pinjaman','pinjaman/*',
                    // 'dashboardanggota','dashboardanggota/*',
                    'petugas','petugas/*',
                    'anggota','anggota/*',
                ]
            ],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
