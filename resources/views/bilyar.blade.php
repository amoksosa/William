<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Billiard Betting Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root{
      --gloss: linear-gradient( to bottom, rgba(255,255,255,.28), rgba(255,255,255,0) 45%);
      --inner-shadow: inset 0 1px 2px rgba(0,0,0,.35), inset 0 -2px 4px rgba(0,0,0,.25);
      --card-radius: 18px;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
    }

    /* Clearer animated background */
    .bg-animated {
      position: fixed;
      top: 0;
      left: 0;
      width: 110%;
      height: 110%;
      background: url('https://i.ibb.co/BKQvKBXG/dffa7d34-4988-4aaa-802f-7fb649a8f8f5.png') center center / cover no-repeat;
      opacity: 0.85;
      z-index: -1;
      animation: moveBg 30s infinite alternate ease-in-out;
      will-change: transform;
    }

    @keyframes moveBg {
      0%   { transform: translate3d(0, 0, 0); }
      50%  { transform: translate3d(-2%, -2%, 0); }
      100% { transform: translate3d(0, -1%, 0); }
    }

    /* ====== 3D BETTING SECTION STYLES ====== */
    .bet-area { perspective: 1200px; }

    .bet-card{
      position: relative;
      border-radius: var(--card-radius);
      overflow: hidden;
      padding: 14px;
      color: #fff;
      transform-style: preserve-3d;
      will-change: transform, box-shadow;
      transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
      border: 1px solid rgba(255,255,255,.12);
      backdrop-filter: saturate(120%) blur(2px);
      box-shadow:
        0 18px 30px rgba(0,0,0,.35),
        0 4px 10px rgba(0,0,0,.35);
    }

    /* sheen highlight */
    .bet-card::before{
      content:"";
      position:absolute;
      inset:0;
      background: radial-gradient(100% 60% at -10% -10%, rgba(255,255,255,.35), rgba(255,255,255,0) 60%) ,
                  var(--gloss);
      mix-blend-mode: screen;
      pointer-events: none;
      transform: translateZ(20px);
    }

    /* subtle bottom edge shine */
    .bet-card::after{
      content:"";
      position:absolute;
      left:8%;
      right:8%;
      bottom:0;
      height:2px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
      filter: blur(.5px);
      transform: translateZ(22px);
      opacity:.7;
    }

    .bet-card:hover{
      transform: translateY(-6px) scale(1.01);
      filter: saturate(110%);
    }

    /* Red variant */
    .bet-card.red{
      background:
        radial-gradient(120% 140% at 100% -10%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%),
        linear-gradient(180deg, #ef4444 0%, #b91c1c 55%, #7f1d1d 100%);
      box-shadow:
        0 18px 32px rgba(185,28,28,.45),
        0 8px 18px rgba(0,0,0,.45);
    }

    /* Blue variant */
    .bet-card.blue{
      background:
        radial-gradient(120% 140% at 100% -10%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%),
        linear-gradient(180deg, #3b82f6 0%, #1d4ed8 55%, #1e3a8a 100%);
      box-shadow:
        0 18px 32px rgba(29,78,216,.45),
        0 8px 18px rgba(0,0,0,.45);
    }

    /* Name chip */
    .name-chip{
      display:inline-block;
      padding: 6px 12px;
      border-radius: 9999px;
      font-weight: 900;
      letter-spacing:.3px;
      background: rgba(0,0,0,.25);
      box-shadow: var(--inner-shadow);
      transform: translateZ(24px);
    }

    /* Amount text pop */
    .amount-3d{
      font-weight: 900;
      text-shadow:
        0 2px 0 rgba(0,0,0,.35),
        0 8px 18px rgba(0,0,0,.35);
      transform: translateZ(26px);
    }

    /* Odds ribbon/badge */
    .odds-ribbon{
      display:inline-block;
      padding: 6px 12px;
      border-radius: 10px;
      font-weight:800;
      background: rgba(0,0,0,.25);
      border: 1px solid rgba(255,255,255,.12);
      box-shadow: var(--inner-shadow);
      transform: translateZ(22px);
    }

    /* Inputs and Buttons */
    .bet-input{
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.18);
      outline: none;
      box-shadow: var(--inner-shadow);
      transition: transform .15s ease, box-shadow .15s ease;
      transform: translateZ(18px);
    }
    .bet-input:focus{
      box-shadow:
        inset 0 2px 4px rgba(0,0,0,.3),
        0 0 0 3px rgba(255,255,255,.08);
      transform: translateZ(20px);
    }

    .bet-btn{
      border-radius: 12px;
      font-weight: 900;
      letter-spacing:.5px;
      border: 1px solid rgba(255,255,255,.18);
      box-shadow:
        0 10px 18px rgba(0,0,0,.35),
        inset 0 1px 2px rgba(255,255,255,.25);
      transition: transform .12s ease, box-shadow .12s ease, filter .12s ease;
      transform: translateZ(24px);
    }
    .bet-btn:hover{ filter: brightness(1.05); }
    .bet-btn:active{
      transform: translateZ(20px) translateY(2px);
      box-shadow:
        0 6px 12px rgba(0,0,0,.35),
        inset 0 2px 4px rgba(0,0,0,.35);
    }

    .bet-btn.red{
      background: linear-gradient(180deg, #b91c1c 0%, #7f1d1d 100%);
    }
    .bet-btn.blue{
      background: linear-gradient(180deg, #1d4ed8 0%, #1e3a8a 100%);
    }

    /* Result text glow */
    .result-glow{
      text-shadow: 0 0 10px rgba(250,204,21,.55);
    }

    /* Card tilt (JS updates transform) */
    .tilt{
      transform: rotateX(0) rotateY(0);
      transition: transform .12s ease;
    }

    /* Side panels slightly more see-through para kita pa rin bg */
    .side-panel{ background: rgba(17,24,39,.35); }
    .main-panel{ background: rgba(17,24,39,.55); }

    /* ===== 3D TOGGLE BUTTONS (Odds / Totalizator) ===== */
    .toggle-wrap{ perspective: 1000px; }
    .toggle-btn{
      position: relative;
      border-radius: 12px;
      font-weight: 900;
      letter-spacing:.5px;
      padding: 8px 12px;
      border: 1px solid rgba(255,255,255,.18);
      transform-style: preserve-3d;
      will-change: transform, box-shadow, filter;
      transition: transform .12s ease, box-shadow .12s ease, filter .12s ease;
      box-shadow:
        0 12px 22px rgba(0,0,0,.45),
        inset 0 1px 2px rgba(255,255,255,.25);
    }
    .toggle-btn::before{
      content:"";
      position:absolute;
      inset:0;
      background: var(--gloss);
      mix-blend-mode: screen;
      border-radius: 12px;
      pointer-events: none;
      transform: translateZ(18px);
    }
    .toggle-btn:hover{
      transform: translateZ(10px) translateY(-2px);
      filter: saturate(110%);
    }
    .toggle-btn:active{
      transform: translateZ(4px) translateY(1px);
      box-shadow:
        0 6px 12px rgba(0,0,0,.45),
        inset 0 2px 4px rgba(0,0,0,.35);
    }
    .toggle-btn.red{
      background: linear-gradient(180deg, #b91c1c 0%, #7f1d1d 100%);
      box-shadow:
        0 14px 26px rgba(185,28,28,.45),
        inset 0 1px 2px rgba(255,255,255,.25);
    }
    .toggle-btn.blue{
      background: linear-gradient(180deg, #1d4ed8 0%, #1e3a8a 100%);
      box-shadow:
        0 14px 26px rgba(29,78,216,.45),
        inset 0 1px 2px rgba(255,255,255,.25);
    }

    /* ===== Header (added) ===== */
    .glass-header{
      background: linear-gradient(to right, rgba(17,24,39,.75), rgba(17,24,39,.55));
      backdrop-filter: blur(8px) saturate(120%);
      border-bottom: 1px solid rgba(255,255,255,.12);
    }
    .header-gloss:before{
      content:"";
      position:absolute;
      inset:0;
      background: radial-gradient(120% 80% at -10% -40%, rgba(255,255,255,.25), rgba(255,255,255,0) 60%);
      pointer-events:none;
    }
    .menu-card{
      background: rgba(17,24,39,.95);
      border:1px solid rgba(255,255,255,.12);
      border-radius:14px;
      box-shadow: 0 18px 30px rgba(0,0,0,.35);
    }

    /* ===== 3D + Shine username (ADDED) ===== */
    .shine-3d{
      font-weight: 900;
      letter-spacing: .3px;
      /* moving highlight across text */
      background: linear-gradient(90deg,
        rgba(255,255,255,.75) 0%,
        #ffffff 25%,
        #ffe08a 45%,
        #ffffff 60%,
        rgba(255,255,255,.75) 100%);
      background-size: 200% auto;
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: shineMove 2.6s linear infinite;
      /* 3D depth + soft glow */
      text-shadow:
        0 1px 0 rgba(0,0,0,.35),
        0 2px 0 rgba(0,0,0,.35),
        0 8px 18px rgba(0,0,0,.5),
        0 0 18px rgba(255, 232, 133, .35);
    }
    @keyframes shineMove{
      0% { background-position: 0% center; }
      100% { background-position: 200% center; }
    }
  </style>
</head>
<body class="text-white font-sans bg-black">

  <div class="bg-animated"></div>

  <!-- ===== Sticky Header (with 3D shiny username, avatar removed) ===== -->
  <header class="glass-header sticky top-0 z-50">
    <div class="relative header-gloss">
      <div class="max-w-7xl mx-auto px-4">
        <div class="h-14 flex items-center justify-between">
          <!-- Left: Brand -->
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-400/80 to-cyan-500/80 ring-2 ring-white/10 shadow-lg shadow-cyan-900/30"></div>
            <div class="leading-tight">
              <div class="text-sm uppercase tracking-widest text-white/70">BILYARAN</div>
            </div>
          </div>

          <!-- Middle: Quick links (placeholders) -->
          <nav class="hidden md:flex items-center gap-4 text-sm text-gray-200">
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Home</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Matches</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">My Bets</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Support</a>
          </nav>

          <!-- Right: Balance mirror + Notifications + Account -->
          <div class="flex items-center gap-2">
            <!-- Compact balance badge (read-only mirror text) -->
            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-yellow-500/15 ring-1 ring-yellow-400/30 text-yellow-300 text-xs font-bold">
              <span class="opacity-80">BALANCE</span>
              <span id="header-balance" class="tracking-wide">5000</span>
            </div>

            <!-- Notifications -->
            <button class="relative p-2 rounded-lg hover:bg-white/10 transition" aria-label="Notifications">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.25 18.75a1.5 1.5 0 11-3 0m8.25-1.5H4.5l1.2-1.2a2.25 2.25 0 00.66-1.59V10.5a5.25 5.25 0 1110.5 0v2.46c0 .6.24 1.18.66 1.6l1.29 1.19z"/>
              </svg>
              <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-gray-900"></span>
            </button>

            <!-- Account dropdown (avatar removed; 3D shiny username) -->
            <div class="relative">
              <button id="account-btn" class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-white/10 transition">
                <div class="text-left">
                  <div class="text-[11px] leading-tight opacity-80 hidden sm:block">Signed in as</div>
                  <div id="account-name" class="shine-3d text-base leading-tight">Account Name</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.206l3.71-3.975a.75.75 0 111.08 1.04l-4.24 4.54a.75.75 0 01-1.08 0l-4.24-4.54a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div id="account-menu" class="menu-card absolute right-0 mt-2 w-56 p-2 hidden">
                <div class="px-3 py-2">
                  <div class="text-xs opacity-70">Logged in as</div>
                  <div class="shine-3d text-lg" id="account-name-menu">Account Name</div>
                </div>
                <hr class="border-white/10 my-1" />
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm">
                  <span>Profile</span>
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm">
                  <span>Settings</span>
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-red-300">
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </header>
  <!-- ===== End Header ===== -->

  <div class="flex justify-center gap-4 p-4">
    <!-- Left Slideshow -->
    <div class="hidden md:block w-48 h-[600px] side-panel rounded-lg overflow-hidden relative">
      <img id="left-slide" class="w-full h-full object-cover transition-all duration-700" src="" alt="slide">
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-lg w-full main-panel p-4 rounded-lg shadow-lg">
      <!-- Header -->
      <div class="flex justify-between items-center mb-2 text-sm text-gray-300">
        <div id="event-date"></div>
        <div id="event-time"></div>
      </div>

      <!-- Video Section -->
      <div class="mb-4">
        <div class="aspect-w-16 aspect-h-9">
          <iframe id="youtube-video" class="w-full h-64 rounded-lg"
            src=""
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
        <input type="text" id="youtube-link" class="w-full mt-2 p-2 rounded text-black text-sm" placeholder="Paste YouTube link here">
        <button onclick="loadYouTubeVideo()" class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-sm">Load Video</button>
      </div>

      <!-- Fight Info -->
      <div class="flex justify-between items-center mb-3">
        <div class="flex items-center space-x-2">
          <img src="https://i.ibb.co/yFL9dyxc/dyis.png" class="w-12 h-12 rounded" alt="rooster">
          <span class="text-lg font-bold">MATCH: 29</span>
        </div>
        <div class="text-xs text-yellow-400">
          PAYOUT WITH 90 AND BELOW SHALL BE CANCELLED
        </div>
      </div>

      <!-- ✨ Toggle Buttons (3D Odds / 3D Totalizator) -->
      <div class="flex gap-2 mb-3 toggle-wrap">
        <button id="btn-odds" class="toggle-btn red text-sm">Odds</button>
        <button id="btn-totalizator" class="toggle-btn blue text-sm">Totalizator</button>
      </div>

      <!-- Betting Section (3D) -->
      <div id="bet-area" class="bet-area grid grid-cols-2 gap-3 mb-4">
        <!-- Player 1 -->
        <div class="bet-card red tilt text-center">
          <div class="flex items-center justify-between">
            <!-- Medyo pinalaki ang MERON/WALA labels -->
            <span class="name-chip text-xl md:text-2xl">MERON</span>
          </div>
          <div class="mt-2 text-sm font-semibold opacity-90" id="player1-name"></div>
          <div class="amount-3d text-3xl md:text-4xl mt-1" id="meron-amount"></div>

          <div class="mt-3">
            <input type="number" class="bet-input w-full p-2 bg-red-900/40 placeholder-white/80 text-white text-sm"
                   placeholder="Enter amount" id="meron-bet">
            <!-- Payout odds moved under the amount input -->
            <div class="mt-2">
              <span class="odds-ribbon" id="meron-odds"></span>
            </div>
            <button class="bet-btn red mt-2 w-full px-3 py-2 text-sm"
                    onclick="placeBet('MERON')">BET</button>
            <div id="meron-result" class="mt-2 text-xs text-yellow-300 result-glow"></div>
          </div>
        </div>

        <!-- Player 2 -->
        <div class="bet-card blue tilt text-center">
          <div class="flex items-center justify-between">
            <span class="name-chip text-xl md:text-2xl">WALA</span>
          </div>
          <div class="mt-2 text-sm font-semibold opacity-90" id="player2-name"></div>
          <div class="amount-3d text-3xl md:text-4xl mt-1" id="wala-amount"></div>

          <div class="mt-3">
            <input type="number" class="bet-input w-full p-2 bg-blue-900/40 placeholder-white/80 text-white text-sm"
                   placeholder="Enter amount" id="wala-bet">
            <!-- Payout odds under the amount input -->
            <div class="mt-2">
              <span class="odds-ribbon" id="wala-odds"></span>
            </div>
            <button class="bet-btn blue mt-2 w-full px-3 py-2 text-sm"
                    onclick="placeBet('WALA')">BET</button>
            <div id="wala-result" class="mt-2 text-xs text-yellow-300 result-glow"></div>
          </div>
        </div>
      </div>

      <!-- ✅ ODDS PANEL (Shown when "Odds" is clicked) -->
      <div id="odds-panel" class="hidden mb-4">
        <!-- top odds badges (synced with totalizator) -->
        <div class="flex items-center justify-between mb-3">
          <div class="bg-red-800/70 border border-white/10 rounded-xl px-3 py-2">
            <div class="text-[10px] uppercase tracking-widest text-gray-300">ODDS MERON</div>
            <div class="text-xl font-extrabold" id="odds-meron-top"></div>
          </div>
          <div class="bg-blue-800/70 border border-white/10 rounded-xl px-3 py-2">
            <div class="text-[10px] uppercase tracking-widest text-gray-300">ODDS WALA</div>
            <div class="text-xl font-extrabold" id="odds-wala-top"></div>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
          <!-- left grid -->
          <div class="col-span-2 grid grid-cols-3 gap-2">
            <!-- Row 1 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="10-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-10</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="10-10">0</button>

            <!-- Row 2 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="10-9">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-9</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="10-9">0</button>

            <!-- Row 3 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="10-8">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-8</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="10-8">0</button>

            <!-- Row 4 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="8-6">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">8-6</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="8-6">0</button>

            <!-- Row 5 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="3-2">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">3-2</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="3-2">0</button>

            <!-- Row 6 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="9-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">9-10</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="9-10">0</button>

            <!-- Row 7 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="8-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">8-10</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="8-10">0</button>

            <!-- Row 8 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="6-8">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">6-8</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="6-8">0</button>

            <!-- Row 9 -->
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="MERON" data-market="2-3">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">2-3</div>
            <button class="bet-target h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs"
              data-side="WALA" data-market="2-3">0</button>
          </div>

          <!-- right controls (3rd section) -->
          <div class="space-y-2">
            <div class="text-xs uppercase tracking-widest text-blue-300 font-bold">ODDS WALA</div>

            <div class="bg-gray-900/70 border border-white/10 rounded-lg p-3 text-sm">
              <div class="flex items-center justify-between">
                <div>
                  <div class="text-xs text-gray-300">Napiling</div>
                  <div class="text-xs -mt-1">Market:</div>
                </div>
                <div class="text-right font-bold">
                  <div id="picked-a">10-</div>
                  <div id="picked-b">10</div>
                </div>
              </div>
            </div>

            <input id="odds-amount" type="number" value="50" class="w-full bg-gray-900/70 border border-white/10 rounded-lg p-2 text-sm" />

            <div class="grid grid-cols-2 gap-2">
              <button id="btn-bet-meron" class="bg-red-800/80 border border-white/10 rounded-lg px-2 py-2 text-xs font-bold">BET MERON</button>
              <button id="btn-bet-wala" class="bg-blue-800/80 border border-white/10 rounded-lg px-2 py-2 text-xs font-bold">BET WALA</button>
            </div>

            <button id="btn-reset" class="w-full bg-gray-800/60 border border-white/10 rounded-lg px-2 py-2 text-xs">Reset</button>
          </div>
        </div>
      </div>

      <!-- Balance -->
      <div class="text-center text-yellow-400 font-bold text-lg mb-4">
        BALANCE: 5000
      </div>

      <!-- Ads Section -->
      <div id="ads" class="grid grid-cols-1 sm:grid-cols-2 gap-3"></div>
    </div>

    <!-- Right Slideshow -->
    <div class="hidden md:block w-48 h-[600px] side-panel rounded-lg overflow-hidden relative">
      <img id="right-slide" class="w-full h-full object-cover transition-all duration-700" src="" alt="slide">
    </div>
  </div>

  <script>
    // Famous billiard players list
    const players = [
      "Efren Reyes", "Earl Strickland", "Ronnie O'Sullivan",
      "Shane Van Boening", "Francisco Bustamante", "Alex Pagulayan",
      "Jeanette Lee", "Karen Corr", "Allison Fisher",
      "Johnny Archer", "Mika Immonen", "Niels Feijen",
      "Darren Appleton", "Ko Pin-Yi", "Wu Jiaqing"
    ];

    // Slideshow images
    const slides = [
      "https://i.ibb.co/jPjC9YqC/raga.jpg",
      "https://i.ibb.co/fd26jLNQ/de-luna.webp",
      "https://i.ibb.co/TBS7P8Cd/mika.jpg",
      "https://i.ibb.co/4nMYxQFp/biado.jpg",
      "https://i.ibb.co/7dSvjwRK/amoroto.jpg",
      "https://i.ibb.co/Q7cQ30tS/efren.webp"
    ];
    let slideIndex = 0;

    function updateSlides() {
      document.getElementById("left-slide").src = slides[slideIndex];
      document.getElementById("right-slide").src = slides[(slideIndex + 3) % slides.length];
      slideIndex = (slideIndex + 1) % slides.length;
    }
    setInterval(updateSlides, 3000);

    // Ads
    const ads = [
      { img: "https://i.ibb.co/TDKSctm2/mlbb.jpg", link: "https://m.mobilelegends.com/" },
      { img: "https://i.ibb.co/sJDW1P2v/nba.webp", link: "https://www.instagram.com/nba/" },
      { img: "https://i.ibb.co/Y4H4FT1D/baccarat.webp", link: "https://www.baccarat.com/en_us/" },
      { img: "https://i.ibb.co/YB7qGJFF/poker.jpg", link: "https://www.247freepoker.com/" },
      { img: "https://i.ibb.co/Y4H4FT1D/baccarat.webp", link: "https://www.baccarat.com/en_us/" }
    ];

    function loadAds() {
      const adsContainer = document.getElementById("ads");
      adsContainer.innerHTML = "";
      let shuffled = [...ads].sort(() => 0.5 - Math.random()).slice(0, 4);
      shuffled.forEach(ad => {
        adsContainer.innerHTML += `
          <a href="${ad.link}" target="_blank" class="block">
            <img src="${ad.img}" class="rounded-lg shadow-md w-full h-32 object-cover hover:scale-105 transition">
          </a>
        `;
      });
    }

    let player1, player2, meronAmount, walaAmount, meronOdds, walaOdds;
    let pickedMarket = "10-10";

    function getRandomAmount() {
      return Math.floor(Math.random() * (50000 - 10000 + 1)) + 10000;
    }

    function getRandomPlayer(exclude) {
      let name;
      do {
        name = players[Math.floor(Math.random() * players.length)];
      } while (name === exclude);
      return name;
    }

    function setDateTime() {
      const now = new Date();
      const optionsDate = { month: '2-digit', day: '2-digit', year: 'numeric' };
      const optionsTime = { weekday: 'short', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
      document.getElementById('event-date').textContent = "EVENT - " + now.toLocaleDateString('en-US', optionsDate);
      document.getElementById('event-time').textContent = now.toLocaleTimeString('en-US', optionsTime) + " ";
    }
    setInterval(setDateTime, 1000);

    function computeOdds() {
      // generate once; both panels will use the exact same values
      meronOdds = (Math.random() * (2.0 - 1.5) + 1.5).toFixed(2);
      walaOdds = (parseFloat(meronOdds) + 0.20).toFixed(2);
    }

    function renderOddsEverywhere(){
      // Totalizator payout badges (now below inputs)
      document.getElementById('meron-odds').textContent = "PAYOUT = " + meronOdds;
      document.getElementById('wala-odds').textContent  = "PAYOUT = " + walaOdds;
      // Odds panel top badges
      document.getElementById('odds-meron-top').textContent = meronOdds;
      document.getElementById('odds-wala-top').textContent  = walaOdds;
    }

    // ==== Simple tilt effect for 3D feel ====
    function attachTilt(el){
      const damp = 6; // max tilt deg
      el.addEventListener('mousemove', (e)=>{
        const r = el.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width;
        const y = (e.clientY - r.top) / r.height;
        const rx = (y - 0.5) * damp;      // rotateX
        const ry = (0.5 - x) * damp;      // rotateY
        el.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) translateY(-6px)`;
      });
      el.addEventListener('mouseleave', ()=>{
        el.style.transform = 'rotateX(0) rotateY(0) translateY(0)';
      });
    }

    window.onload = () => {
      setDateTime();
      player1 = getRandomPlayer();
      player2 = getRandomPlayer(player1);

      document.getElementById('player1-name').textContent = player1;
      document.getElementById('player2-name').textContent = player2;

      meronAmount = getRandomAmount();
      walaAmount = getRandomAmount();

      computeOdds();
      renderOddsEverywhere();

      document.getElementById('meron-amount').textContent = meronAmount.toLocaleString();
      document.getElementById('wala-amount').textContent = walaAmount.toLocaleString();

      updateSlides();
      loadAds();

      // init tilt on the 3D cards
      document.querySelectorAll('.tilt').forEach(attachTilt);

      // ===== Toggle logic: Odds / Totalizator =====
      const betArea = document.getElementById('bet-area');
      const oddsPanel = document.getElementById('odds-panel');

      // default view = Totalizator (betting section visible)
      betArea.style.display = 'grid';
      oddsPanel.classList.add('hidden');

      document.getElementById('btn-odds').addEventListener('click', ()=>{
        betArea.style.display = 'none';
        oddsPanel.classList.remove('hidden');
      });
      document.getElementById('btn-totalizator').addEventListener('click', ()=>{
        oddsPanel.classList.add('hidden');
        betArea.style.display = 'grid';
      });

      // ==== Odds panel interactions ====
      document.querySelectorAll('.bet-target').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          pickedMarket = btn.dataset.market;
          updatePickedMarket(pickedMarket);
          const side = btn.dataset.side; // MERON or WALA
          betFromOdds(side, pickedMarket);
        });
      });

      document.getElementById('btn-bet-meron').addEventListener('click', ()=>betFromOdds('MERON', pickedMarket));
      document.getElementById('btn-bet-wala').addEventListener('click', ()=>betFromOdds('WALA', pickedMarket));
      document.getElementById('btn-reset').addEventListener('click', ()=>{
        pickedMarket = '10-10';
        updatePickedMarket(pickedMarket);
        document.getElementById('odds-amount').value = 50;
      });

      updatePickedMarket(pickedMarket);

      // ===== Header small helpers =====
      // Mirror the big balance into header badge once at load:
      const bigBalanceEl = document.querySelector('.text-center.text-yellow-400.font-bold.text-lg.mb-4');
      if (bigBalanceEl) {
        const match = bigBalanceEl.textContent.match(/BALANCE:\s*([\d.,]+)/i);
        if (match) document.getElementById('header-balance').textContent = match[1];
      }

      // Example: set account name (replace with real username when you wire auth)
      const name = 'AMOK';
      document.getElementById('account-name').textContent = name;
      document.getElementById('account-name-menu').textContent = name;

      // Dropdown toggle
      const btn = document.getElementById('account-btn');
      const menu = document.getElementById('account-menu');
      btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
      // click outside to close
      document.addEventListener('click', (e)=>{
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
          menu.classList.add('hidden');
        }
      });
    };

    function updatePickedMarket(mkt){
      const [a,b] = mkt.split('-');
      document.getElementById('picked-a').textContent = a + '-';
      document.getElementById('picked-b').textContent = b;
    }

    function betFromOdds(side, market){
      const amt = parseFloat(document.getElementById('odds-amount').value);
      if (isNaN(amt) || amt <= 0) {
        alert('Please enter a valid amount.');
        return;
      }
      const odds = side === 'MERON' ? meronOdds : walaOdds;
      const payout = (amt * parseFloat(odds)).toFixed(2);
      alert(`ODDS BET: ${side} @ ${market}\nAmount: ${amt}\nPossible payout: ${payout}`);
    }

    function placeBet(betType) {
      let betAmount = betType === 'MERON'
        ? document.getElementById('meron-bet').value
        : document.getElementById('wala-bet').value;
      let odds = betType === 'MERON' ? meronOdds : walaOdds;
      let chosenPlayer = betType === 'MERON' ? player1 : player2;

      if (betAmount === "" || betAmount <= 0) {
        alert("Please enter a valid bet amount.");
        return;
      }

      let totalWinnings = parseFloat(betAmount) * odds;

      if (betType === 'MERON') {
        document.getElementById('meron-result').textContent = `${chosenPlayer} Winnings: ${totalWinnings.toFixed(2)}`;
      } else {
        document.getElementById('wala-result').textContent = `${chosenPlayer} Winnings: ${totalWinnings.toFixed(2)}`;
      }

      alert(`You placed a bet of ${betAmount} on ${chosenPlayer}. Possible payout: ${totalWinnings.toFixed(2)}.`);
    }

    function loadYouTubeVideo() {
      const link = document.getElementById("youtube-link").value;
      if (!link) {
        alert("Please paste a YouTube link.");
        return;
      }
      let videoId = "";
      const url = new URL(link);
      if (url.hostname.includes("youtube.com")) {
        videoId = url.searchParams.get("v");
      } else if (url.hostname.includes("youtu.be")) {
        videoId = url.pathname.slice(1);
      }
      if (videoId) {
        document.getElementById("youtube-video").src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1`;
      } else {
        alert("Invalid YouTube link.");
      }
    }
  </script>
</body>
</html>
