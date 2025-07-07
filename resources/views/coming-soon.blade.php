<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZTX7Q6K11W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-ZTX7Q6K11W');
    </script>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>

    <!-- FAVICONS -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" sizes="16x16" />
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}" sizes="180x180" />
    <link rel="manifest" href="site.webmanifest" />

    <!-- SEO META -->
    <meta name="description" content="Clinky - A Link-in-Bio tool to help you share your links, grow your sales, and engage your audience. Sign up to be the first to know when we launch!" />
    <meta name="keywords" content="Clinky, link in bio, social links, newsletter, launch" />
    <meta name="author" content="Thr33, Inc." />

    <!-- Open Graph -->
    <meta property="og:title" content="Clinky - Link-in-Bio" />
    <meta property="og:description" content="Be the first to know when Clinky launches. Share your links, grow your sales, and engage your audience!" />
    <meta property="og:image" content="https://clinky.cc/assets/bg.jpg" />
    <meta property="og:url" content="https://clinky.cc" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Clinky" />
   
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Clinky - Link-in-Bio" />
    <meta name="twitter:description" content="Share your links, grow your sales, and engage your audience. Sign up now!" />
    <meta name="twitter:image" content="https://clinky.cc/assets/bg.jpg" />

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cascadia+Mono:wght@200..700&family=Montserrat:wght@100..900&family=Noto+Sans:wght@100..900&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-..."
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <title>Clinky Link-in-Bio - Coming Soon</title>

  <style>
    /* RESET & BASE */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
      font-family: 'Montserrat', sans-serif;
      background: url('{{ asset('images/bg.jpg') }}') no-repeat center/cover fixed;
      color: #fff;
      display: flex;
      flex-direction: row;
    }

    /* CONTEXT BOX */
    .invisible {
        width: 50%;
        display: block;
    }
    .context {
        width: 50%;
        margin-left: 0;
        margin-right: auto;
        padding: 60px;
        text-align: center;
        background: #892ae294;
        
    }

    @media (max-width: 1024px) {
      .context {
        width: 100%;
        padding:80px 40px;
        margin: 0 auto 20px;     /* center on mobile */
        height: 50%;
        background: linear-gradient(180deg, #8d2de28a, #8d2de200);
      }
        .invisible {
            display: none;
        }
    }

    /* LOGO */
    img.logo {
        max-width: 220px;
        margin: 0 auto 1rem;
        display: block;
        /* force SVG to white */
        filter: brightness(0) invert(1)
            /* add a subtle shadow: x-offset y-offset blur color */
            drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.3));
    }

    .logo svg path {
        fill: #fff;
    }

    /* STATIC HEADLINES */
    h1 {
        font-size: 2.2rem;
        margin: 2rem 0 1rem;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        font-weight: 700;
    }
    h2 {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      text-shadow: 0 1px 2px rgba(0,0,0,0.2);
      font-weight: 500;
      padding: 0 1.5rem;
    }


    /* CENTERED CARD */
    main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }

    .card {
      display: flex;
      background: #fff;
      color: #111;
      border-radius: 20px;
      max-width: 800px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .card-image {
      flex: 1;
      background: linear-gradient(45deg, #8E2DE2, #4A00E0);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    .card-image i {
      font-size: 4rem;
      color: #fff;
    }
    .card-content {
      flex: 2;
      padding: 2rem;
    }
    .card-content h3 {
        margin-bottom: 0.5rem;
        font-size: 1.4rem;
        text-align: left;
        font-weight: 600;
    }
    .card-content p {
      margin-bottom: 1.5rem;
      color: #555;
      font-weight: 500;
      text-align: left;
    }

    /* FORM STYLES */
    .card-content form { display: flex; flex-direction: column; }
    .card-content input[type="email"],
    .card-content input[type="text"] {
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 1rem;
      width: 100%;
    }
    #mc-embedded-subscribe {
      padding: 1rem 2rem;
      font-size: 1rem;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      background: linear-gradient(45deg, #8E2DE2, #4A00E0);
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: .5rem;
    }
    #mc-embedded-subscribe:hover { opacity: 0.9; }

    @media (max-width: 600px) {
      .card { flex-direction: column; }
      .card-image, .card-content { padding: 1.5rem; }
      .made-by { margin-bottom: 40px }
    }

    /* FOOTER */
    footer { text-align: center; padding: 1rem 0; color: #fff; }
    .social-icons {
        margin-bottom: 1rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    .social-icons a { margin: 1rem 0.5rem; color: #fff; font-size: 1.2rem; }
    .social-icons a:hover { opacity: 0.8; }
    .made-by { margin-top: 0.5rem; margin-bottom: 40px }
  </style>
</head>
<body>
  <div class="invisible"></div>
  <div class="context">
    <!-- Logo -->
    <img src="{{ asset('images/clinky.svg') }}" alt="Clinky Logo" class="logo"/>

    <!-- Static headings -->
    <h1>A Link-in-Bio made for you</h1>
    <h2>We are launching soon and you can be one of the early birds and guarantee your URL!</h2>

    <!-- Signup card -->
    <main>
      
      <div class="card">
        <div class="card-image">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="card-content">
          <h3>Get to know!</h3>
          <p>Sign up now for our newsletter</p>

          <!-- Mailchimp embed -->
          <div id="mc_embed_signup">
            <form action="https://clinky.us6.list-manage.com/subscribe/post?u=dafbfb6c3e6fb5f9994ce2375&amp;id=2d11ead9f9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
              <div id="mc_embed_signup_scroll">
                <input type="text" name="FNAME" class="text" id="mce-FNAME" placeholder="Name">
                <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address" required>
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                  <input type="text" name="b_dafbfb6c3e6fb5f9994ce2375_2d11ead9f9" tabindex="-1" value="">
                </div>
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">
              </div>
            </form>
          </div>

        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer>
      <div class="social-icons">
        <p>Follow us</p>
        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/showcase/clinkycc" target="_blank"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <div class="made-by">Clinky © 2025 - Made with <i class="fas fa-heart"></i> for you!</div>
    </footer>
  </div>

</body>
</html>
