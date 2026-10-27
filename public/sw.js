importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');

const staticCacheName = 'djpol-static-v4-202302151203';

workbox.setConfig({ debug: false });

workbox.core.skipWaiting();
workbox.core.clientsClaim();

workbox.routing.registerRoute(
        new RegExp('/captcha-image'),
        new workbox.strategies.NetworkOnly()
        );

workbox.routing.registerRoute(
        new RegExp('\.(png|svg|jpg|jpeg|css|js|woff2|ico)$'),
        new workbox.strategies.CacheFirst({
            cacheName: staticCacheName,
            plugins: [
                new workbox.cacheableResponse.Plugin({
                    statuses: [0, 200],
                }),
                new workbox.expiration.Plugin({
                    maxAgeSeconds: 60 * 60 * 24 * 365,
                    purgeOnQuotaError: true
                })
            ]
        })
        );
workbox.precaching.precacheAndRoute([]);

self.addEventListener('activate', evt => {
    evt.waitUntil(
        caches.keys().then(keys =>{
            return Promise.all(keys
                    .filter(key => key !== staticCacheName)
                    .map(key => caches.delete(key))
            )
        })
    );
});

self.addEventListener('fetch', evt => {
    evt.respondWith(
        caches.match(evt.request).then(cacheRes => {
            return cacheRes || fetch(evt.request);
        })
    );
});