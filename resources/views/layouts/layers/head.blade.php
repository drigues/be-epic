{{-- LAYOUTS/LAYERS/HEAD.BLADE.PHP --}}

{{-- Google tag (gtag.js) --}}
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZTX7Q6K11W"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-ZTX7Q6K11W');
</script>

{{-- SEO META --}}
<meta name="description"
    content="Clinky # A Link-in-Bio tool to help you share your links, grow your sales, and engage your audience. Sign up to be the first to know when we launch!" />
<meta name="keywords" content="Clinky, link in bio, social links, newsletter, launch" />
<meta name="author" content="Thr33 Co" />

{{-- Open Graph --}}
<meta property="og:title" content="Clinky # Link-in-Bio" />
<meta property="og:description"
    content="Be the first to know when Clinky launches. Share your links, grow your sales, and engage your audience!" />
<meta property="og:image" content="https://clinky.cc/images/sharing-clinky.png" />
<meta property="og:url" content="https://clinky.cc" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Clinky" />

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Clinky - Link-in-Bio" />
<meta name="twitter:description" content="Share your links, grow your sales, and engage your audience. Sign up now!" />
<meta name="twitter:image" content="https://clinky.cc/images/sharing-clinky.png" />

{{-- GOOGLE FONTS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Cascadia+Mono:wght@200..700&family=Montserrat:wght@100..900&family=Noto+Sans:wght@100..900&display=swap"
    rel="stylesheet">

{{-- FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Bootstrap CSS via CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-…" crossorigin="anonymous">

{{-- Built CSS/JS --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@vite(['resources/css/guest.css', 'resources/js/guest.js'])

{{-- <title>{{ config('app.name', 'Clinky') }}</title> --}}