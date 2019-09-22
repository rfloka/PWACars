const PRECACHE = 'precache-v1';
const dynamicCache = 'cache-dynamic-v1';
const RUNTIME = 'runtime';

const PRECACHE_URLS = [
  '/offline',
  './css/estilo.css',
  './css/mobile.css',
  './js/main.js',
  './js/tinder.js',
  './js/app.js',
  './js/combustivel.js',
  './js/tipocarro.js',
  './img/1.jpg',
  './img/2.jpg',
  './img/3.jpg',
  './img/4.jpg',
  './img/banner.png',
  './img/offline.png',
  './img/logo.png',
  'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
  'https://use.fontawesome.com/releases/v5.7.2/css/all.css'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(PRECACHE)
      .then(cache => cache.addAll(PRECACHE_URLS))
      .then(self.skipWaiting())
  );
});

self.addEventListener('activate', event => {
  const currentCaches = [PRECACHE, RUNTIME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return cacheNames.filter(cacheName => !currentCaches.includes(cacheName));
    }).then(cachesToDelete => {
      return Promise.all(cachesToDelete.map(cacheToDelete => {
        return caches.delete(cacheToDelete);
      }));
    }).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', event => {
  console.log('fetch event',event);
  event.respondWith(
    caches.match(event.request).then(cacheRes=>{
      return cacheRes || fetch(event.request)/*.then(fetchRes=>{
        return cache.open(dynamicCache).then(cache=>{
          cache.put(event.request.url, fetchRes.clone());
          return fetchRes;
        })
      });*/
    }).catch(()=> caches.match('/offline'))
  );
});
