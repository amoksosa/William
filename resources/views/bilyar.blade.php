<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bilyaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root{
      --gloss: linear-gradient( to bottom, rgba(255,255,255,.28), rgba(255,255,255,0) 45%);
      --inner-shadow: inset 0 1px 2px rgba(0,0,0,.35), inset 0 -2px 4px rgba(0,0,0,.25);
      --card-radius: 18px;

      /* 3D Logro defaults */
      --logro-bubble: 22px;   /* diameter ng bola sa logrohan */
      --logro-step: 10px;     /* kapal ng isang “patong” sa Z */
      --logro-tilt: 34deg;    /* default rotateX ng rail (naka higa) */
      --logro-rail-h: 48px;   /* taas ng rail (visual only) */
    }

    body, html { margin:0; padding:0; height:100%; overflow-x:hidden; }

    .bg-animated{
      position:fixed; top:0; left:0; width:110%; height:110%;
      background:url('https://i.ibb.co/BKQvKBXG/dffa7d34-4988-4aaa-802f-7fb649a8f8f5.png') center/cover no-repeat;
      opacity:.85; z-index:-1; animation:moveBg 30s infinite alternate ease-in-out; will-change:transform;
    }
    @keyframes moveBg{ 0%{transform:translate3d(0,0,0)} 50%{transform:translate3d(-2%,-2%,0)} 100%{transform:translate3d(0,-1%,0)} }

    .bet-area{ perspective:1200px; }
    .bet-card{ position:relative; border-radius:var(--card-radius); overflow:hidden; padding:14px; color:#fff;
      transform-style:preserve-3d; will-change:transform, box-shadow; transition:transform .2s, box-shadow .2s, filter .2s;
      border:1px solid rgba(255,255,255,.12); backdrop-filter:saturate(120%) blur(2px);
      box-shadow:0 18px 30px rgba(0,0,0,.35), 0 4px 10px rgba(0,0,0,.35);
    }
    .bet-card::before{ content:""; position:absolute; inset:0;
      background: radial-gradient(100% 60% at -10% -10%, rgba(255,255,255,.35), rgba(255,255,255,0) 60%), var(--gloss);
      mix-blend-mode:screen; pointer-events:none; transform:translateZ(20px);
    }
    .bet-card::after{ content:""; position:absolute; left:8%; right:8%; bottom:0; height:2px;
      background:linear-gradient(90deg,transparent,rgba(255,255,255,.35),transparent); filter:blur(.5px);
      transform:translateZ(22px); opacity:.7;
    }
    .bet-card:hover{ transform:translateY(-6px) scale(1.01); filter:saturate(110%); }
    .bet-card.red{
      background: radial-gradient(120% 140% at 100% -10%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%),
                  linear-gradient(180deg,#ef4444 0%,#b91c1c 55%,#7f1d1d 100%);
      box-shadow:0 18px 32px rgba(185,28,28,.45), 0 8px 18px rgba(0,0,0,.45);
    }
    .bet-card.blue{
      background: radial-gradient(120% 140% at 100% -10%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%),
                  linear-gradient(180deg,#3b82f6 0%,#1d4ed8 55%,#1e3a8a 100%);
      box-shadow:0 18px 32px rgba(29,78,216,.45), 0 8px 18px rgba(0,0,0,.45);
    }
    .name-chip{ display:inline-block; padding:6px 12px; border-radius:9999px; font-weight:900; letter-spacing:.3px;
      background:rgba(0,0,0,.25); box-shadow:var(--inner-shadow); transform:translateZ(24px);
    }
    .amount-3d{ font-weight:900; text-shadow:0 2px 0 rgba(0,0,0,.35), 0 8px 18px rgba(0,0,0,.35); transform:translateZ(26px); }
    .odds-ribbon{ display:inline-block; padding:6px 12px; border-radius:10px; font-weight:800; background:rgba(0,0,0,.25);
      border:1px solid rgba(255,255,255,.12); box-shadow:var(--inner-shadow); transform:translateZ(22px);
    }
    .bet-input{ border-radius:12px; border:1px solid rgba(255,255,255,.18); outline:none; box-shadow:var(--inner-shadow);
      transition:transform .15s, box-shadow .15s; transform:translateZ(18px);
    }
    .bet-input:focus{ box-shadow:inset 0 2px 4px rgba(0,0,0,.3), 0 0 0 3px rgba(255,255,255,.08); transform:translateZ(20px); }
    .bet-btn{ border-radius:12px; font-weight:900; letter-spacing:.5px; border:1px solid rgba(255,255,255,.18);
      box-shadow:0 10px 18px rgba(0,0,0,.35), inset 0 1px 2px rgba(255,255,255,.25);
      transition:transform .12s, box-shadow .12s, filter .12s; transform:translateZ(24px);
    }
    .bet-btn:hover{ filter:brightness(1.05); }
    .bet-btn:active{ transform:translateZ(20px) translateY(2px); box-shadow:0 6px 12px rgba(0,0,0,.35), inset 0 2px 4px rgba(0,0,0,.35); }
    .bet-btn.red{ background:linear-gradient(180deg,#b91c1c 0%,#7f1d1d 100%); }
    .bet-btn.blue{ background:linear-gradient(180deg,#1d4ed8 0%,#1e3a8a 100%); }
    .result-glow{ text-shadow:0 0 10px rgba(250,204,21,.55); }
    .tilt{ transform:rotateX(0) rotateY(0); transition:transform .12s; }
    .side-panel{ background:rgba(17,24,39,.35); }
    .main-panel{ background:rgba(17,24,39,.55); }

    .toggle-wrap{ perspective:1000px; }
    .toggle-btn{ position:relative; border-radius:12px; font-weight:900; letter-spacing:.5px; padding:8px 12px;
      border:1px solid rgba(255,255,255,.18); transform-style:preserve-3d; will-change:transform, box-shadow, filter;
      transition:transform .12s, box-shadow .12s, filter .12s;
      box-shadow:0 12px 22px rgba(0,0,0,.45), inset 0 1px 2px rgba(255,255,255,.25);
    }
    .toggle-btn::before{ content:""; position:absolute; inset:0; background:var(--gloss); mix-blend-mode:screen; border-radius:12px; pointer-events:none; transform:translateZ(18px); }
    .toggle-btn:hover{ transform:translateZ(10px) translateY(-2px); filter:saturate(110%); }
    .toggle-btn:active{ transform:translateZ(4px) translateY(1px); box-shadow:0 6px 12px rgba(0,0,0,.45), inset 0 2px 4px rgba(0,0,0,.35); }
    .toggle-btn.red{ background:linear-gradient(180deg,#b91c1c 0%,#7f1d1d 100%); box-shadow:0 14px 26px rgba(185,28,28,.45), inset 0 1px 2px rgba(255,255,255,.25); }
    .toggle-btn.blue{ background:linear-gradient(180deg,#1d4ed8 0%,#1e3a8a 100%); box-shadow:0 14px 26px rgba(29,78,216,.45), inset 0 1px 2px rgba(255,255,255,.25); }

    .glass-header{ background:linear-gradient(to right, rgba(17,24,39,.75), rgba(17,24,39,.55)); backdrop-filter:blur(8px) saturate(120%); border-bottom:1px solid rgba(255,255,255,.12); }
    .header-gloss:before{ content:""; position:absolute; inset:0; background:radial-gradient(120% 80% at -10% -40%, rgba(255,255,255,.25), rgba(255,255,255,0) 60%); pointer-events:none; }
    .menu-card{ background:rgba(17,24,39,.95); border:1px solid rgba(255,255,255,.12); border-radius:14px; box-shadow:0 18px 30px rgba(0,0,0,.35); }

    .shine-3d{
      font-weight:900; letter-spacing:.3px;
      background:linear-gradient(90deg, rgba(255,255,255,.75) 0%, #ffffff 25%, #ffe08a 45%, #ffffff 60%, rgba(255,255,255,.75) 100%);
      background-size:200% auto; -webkit-background-clip:text; background-clip:text; color:transparent;
      animation:shineMove 2.6s linear infinite;
      text-shadow:0 1px 0 rgba(0,0,0,.35), 0 2px 0 rgba(0,0,0,.35), 0 8px 18px rgba(0,0,0,.5), 0 0 18px rgba(255,232,133,.35);
    }
    @keyframes shineMove{ 0%{background-position:0% center} 100%{background-position:200% center} }
    .brand-logo{ filter:drop-shadow(0 0 6px rgba(16,185,129,.7)); }

    /* ===================== LOGROHAN 3D ===================== */
    .logro-zone{ perspective: 1100px; overflow: visible; }

    /* Default: naka-tilt (3D look), Hover: flatten (tanggal higa) */
    .logro-rail{
      position: relative;
      transform-style: preserve-3d;
      transform-origin: bottom center;
      transition: transform .25s ease, box-shadow .25s ease;
      padding: 12px 10px 18px 10px;
      background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
      border: 1px solid rgba(255,255,255,.10);
      border-radius: 14px;
      box-shadow: 0 20px 40px rgba(0,0,0,.45), inset 0 4px 10px rgba(255,255,255,.04);
      will-change: transform;
    }
    .logro-rail:hover{
      transform: rotateX(0deg) translateY(0); /* flatten */
      box-shadow: 0 16px 28px rgba(0,0,0,.38), inset 0 4px 10px rgba(255,255,255,.05);
    }

    .logro-rail::before{
      content:"";
      position:absolute; inset:0;
      border-radius:14px;
      background: radial-gradient(120% 80% at 0% -30%, rgba(255,255,255,.18), transparent 60%);
      mix-blend-mode: screen;
      pointer-events:none;
      transform: translateZ(1px);
    }
    .logro-rail::after{
      content:"";
      position:absolute; left:6px; right:6px; bottom:-18px; height:26px;
      border-radius: 20px;
      filter: blur(10px);
      background: radial-gradient(60% 100% at 50% 0%, rgba(0,0,0,.45), transparent 60%);
      transform: translateZ(-2px);
      pointer-events:none;
    }

    .logro-strip-3d{
      display:flex; gap: 8px;
      min-height: var(--logro-rail-h);
      transform-style: preserve-3d;
      overflow-x: auto;
      overflow-y: visible;
      padding-bottom: 10px;
      scrollbar-width: thin;
      scrollbar-color: rgba(255,255,255,.25) transparent;
    }
    .logro-strip-3d::-webkit-scrollbar{ height:8px }
    .logro-strip-3d::-webkit-scrollbar-thumb{ background:rgba(255,255,255,.25); border-radius:8px }

    .logro-col{
      position: relative;
      min-width: calc(var(--logro-bubble) + 2px);
      transform-style: preserve-3d;
      display:flex; flex-direction:column; align-items:center; justify-content:flex-start;
      padding-top: 2px;
    }
    .logro-col::after{
      content:"";
      position:absolute; bottom:-6px; width:80%; height:6px;
      border-radius: 999px;
      background: radial-gradient(100% 100% at 50% 50%, rgba(0,0,0,.55), rgba(0,0,0,0) 70%);
      transform: translateZ(-2px);
      pointer-events:none;
    }

    .logro-bubble{
      width:var(--logro-bubble); height:var(--logro-bubble); border-radius:9999px;
      display:flex; align-items:center; justify-content:center;
      position:relative;
      transform-style: preserve-3d;
      box-shadow:
        inset 0 1px 2px rgba(0,0,0,.35),
        inset 0 -4px 6px rgba(0,0,0,.35),
        0 2px 4px rgba(0,0,0,.45);
      will-change: transform, filter;
      transition: transform .15s ease, filter .15s ease;
      font-size: 11px; font-weight: 900; color:#fff; /* number style */
      text-shadow: 0 1px 0 rgba(0,0,0,.4), 0 1px 4px rgba(0,0,0,.6);
    }
    .logro-bubble::before{
      content:""; position:absolute; inset:-1px; border-radius:inherit;
      background: radial-gradient(100% 100% at 30% 25%, rgba(255,255,255,.45), transparent 55%);
      mix-blend-mode: screen; pointer-events:none; transform: translateZ(2px);
    }
    .logro-bubble::after{
      content:""; position:absolute; inset:0; border-radius:inherit;
      border:1px solid rgba(255,255,255,.25);
      box-shadow: inset 0 0 0 1.5px rgba(0,0,0,.25);
      pointer-events:none; transform: translateZ(1px);
    }
    .logro-red{
      background: radial-gradient(100% 120% at 30% 20%, #ff7a7a, #ef4444 55%, #7f1d1d 100%);
      border:1px solid #7f1d1d;
    }
    .logro-blue{
      background: radial-gradient(100% 120% at 30% 20%, #7fb0ff, #3b82f6 55%, #1e3a8a 100%);
      border:1px solid #1e3a8a;
    }
    .logro-bubble:hover{
      filter: brightness(1.05) saturate(1.05);
      transform: translateZ(calc(var(--z, 0px) + 3px)) scale(1.03);
    }

    .logro-legend .logro-chip{
      width: 16px; height:16px; border-radius:9999px;
      box-shadow: inset 0 1px 2px rgba(0,0,0,.35), 0 1px 2px rgba(0,0,0,.35);
    }
    .logro-chip.red{ background:#ef4444; border:1px solid #7f1d1d; }
    .logro-chip.blue{ background:#3b82f6; border:1px solid #1e3a8a; }

    /* Matches strip */
    .matches-pill{ white-space:nowrap; }
    .matches-pill.active{ outline:2px solid rgba(250,204,21,.9); background:rgba(250,204,21,.15); }
  </style>
</head>
<body class="text-white font-sans bg-black">

  <div class="bg-animated"></div>

  <!-- ===== Sticky Header ===== -->
  <header class="glass-header sticky top-0 z-50">
    <div class="relative header-gloss">
      <div class="max-w-7xl mx-auto px-4">
        <div class="h-14 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <svg class="brand-logo w-8 h-8" viewBox="0 0 100 100" aria-label="Bilyaran logo">
              <path d="M50 10 L90 80 H10 Z" fill="none" stroke="#10b981" stroke-width="8" />
              <rect x="58" y="14" width="8" height="42" rx="2" fill="#f59e0b" transform="rotate(35 62 35)"/>
              <circle cx="84" cy="40" r="4" fill="#10b981" />
              <circle cx="50" cy="50" r="22" fill="#0b0f14" stroke="#10b981" stroke-width="3"/>
              <circle cx="50" cy="50" r="12" fill="#ffffff"/>
              <text x="50" y="54" text-anchor="middle" font-size="12" font-weight="700" fill="#0b0f14">8</text>
            </svg>
            <div class="leading-tight">
              <div class="text-sm uppercase tracking-widest text-white/70">BILYARAN</div>
            </div>
          </div>

          <nav class="hidden md:flex items-center gap-4 text-sm text-gray-200">
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Home</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Matches</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">My Bets</a>
            <a href="#" class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">Support</a>
          </nav>

          <div class="flex items-center gap-2">
            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-yellow-500/15 ring-1 ring-yellow-400/30 text-yellow-300 text-xs font-bold">
              <span class="opacity-80">BALANCE</span>
              <span id="header-balance" class="tracking-wide">5000</span>
            </div>
            <button class="relative p-2 rounded-lg hover:bg-white/10 transition" aria-label="Notifications">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.25 18.75a1.5 1.5 0 11-3 0m8.25-1.5H4.5l1.2-1.2a2.25 2.25 0 00.66-1.59V10.5a5.25 5.25 0 1110.5 0v2.46c0 .6.24 1.18.66 1.6l1.29 1.19z"/>
              </svg>
              <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-gray-900"></span>
            </button>

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
              <div id="account-menu" class="menu-card absolute right-0 mt-2 w-56 p-2 hidden">
                <div class="px-3 py-2">
                  <div class="text-xs opacity-70">Logged in as</div>
                  <div class="shine-3d text-lg" id="account-name-menu">Account Name</div>
                </div>
                <hr class="border-white/10 my-1" />
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm"><span>Profile</span></a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm"><span>Settings</span></a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-red-300"><span>Logout</span></a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </header>

  <div class="flex justify-center gap-4 p-4">
    <!-- Left Slideshow -->
    <div class="hidden md:block w-48 h-[600px] side-panel rounded-lg overflow-hidden relative">
      <img id="left-slide" class="w-full h-full object-cover transition-all duration-700" src="" alt="slide">
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-lg w-full main-panel p-4 rounded-lg shadow-lg">
      <div class="flex justify-between items-center mb-2 text-sm text-gray-300">
        <div id="event-date"></div>
        <div id="event-time"></div>
      </div>

      <div class="mb-4">
        <div class="aspect-w-16 aspect-h-9">
          <iframe id="youtube-video" class="w-full h-64 rounded-lg" src="" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <input type="text" id="youtube-link" class="w-full mt-2 p-2 rounded text-black text-sm" placeholder="Paste YouTube link here">
        <button onclick="loadYouTubeVideo()" class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-sm">Load Video</button>
      </div>

      <!-- ✅ MATCHES STRIP -->
      <div class="mb-3">
        <div class="flex items-center justify-between mb-1">
          <div class="text-[11px] uppercase tracking-widest text-white/70">Matches</div>
          <div class="text-xs text-yellow-300 font-bold">Click a pill to load names</div>
        </div>
        <div id="matches-strip" class="flex gap-2 overflow-x-auto pb-2"></div>
      </div>

      <div class="flex justify-between items-center mb-3">
        <div class="flex items-center space-x-2">
          <img src="https://i.ibb.co/yFL9dyxc/dyis.png" class="w-12 h-12 rounded" alt="rooster">
          <span class="text-lg font-bold">MATCH: <span id="match-no">29</span></span>
        </div>
        <div class="text-xs text-yellow-400">PAYOUT WITH 90 AND BELOW SHALL BE CANCELLED</div>
      </div>

      <div class="flex gap-2 mb-3 toggle-wrap">
        <button id="btn-odds" class="toggle-btn red text-sm">Odds</button>
        <button id="btn-totalizator" class="toggle-btn blue text-sm">Totalizator</button>
      </div>

      <div id="bet-area" class="bet-area grid grid-cols-2 gap-3 mb-4">
        <div class="bet-card red tilt text-center">
          <div class="flex items-center justify-between"><span class="name-chip text-xl md:text-2xl">R</span></div>
          <div class="mt-2 text-sm font-semibold opacity-90" id="player1-name"></div>
          <div class="amount-3d text-3xl md:text-4xl mt-1" id="meron-amount"></div>
          <div class="mt-3">
            <input type="number" class="bet-input w-full p-2 bg-red-900/40 placeholder-white/80 text-white text-sm" placeholder="Enter amount" id="meron-bet">
            <div class="mt-2"><span class="odds-ribbon" id="meron-odds"></span></div>
            <button class="bet-btn red mt-2 w-full px-3 py-2 text-sm" onclick="placeBet('MERON')">BET</button>
            <div id="meron-result" class="mt-2 text-xs text-yellow-300 result-glow"></div>
          </div>
        </div>

        <div class="bet-card blue tilt text-center">
          <div class="flex items-center justify-between"><span class="name-chip text-xl md:text-2xl">B</span></div>
          <div class="mt-2 text-sm font-semibold opacity-90" id="player2-name"></div>
          <div class="amount-3d text-3xl md:text-4xl mt-1" id="wala-amount"></div>
          <div class="mt-3">
            <input type="number" class="bet-input w-full p-2 bg-blue-900/40 placeholder-white/80 text-white text-sm" placeholder="Enter amount" id="wala-bet">
            <div class="mt-2"><span class="odds-ribbon" id="wala-odds"></span></div>
            <button class="bet-btn blue mt-2 w-full px-3 py-2 text-sm" onclick="placeBet('WALA')">BET</button>
            <div id="wala-result" class="mt-2 text-xs text-yellow-300 result-glow"></div>
          </div>
        </div>
      </div>

      <!-- ✅ ODDS PANEL -->
      <div id="odds-panel" class="hidden mb-4">
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
          <div class="col-span-2 grid grid-cols-3 gap-2">
            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="10-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-10</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="10-10">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="10-9">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-9</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="10-9">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="10-8">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">10-8</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="10-8">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="8-6">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">8-6</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="8-6">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="3-2">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">3-2</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="3-2">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="9-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">9-10</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="9-10">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="8-10">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">8-10</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="8-10">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="6-8">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">6-8</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="6-8">0</button>

            <button class="bet-target h-16 rounded-lg bg-red-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="MERON" data-market="2-3">0</button>
            <div class="h-16 rounded-lg bg-gray-900/70 border border-white/10 flex items-center justify-center text-xs">2-3</div>
            <button class="bet-target h-16 rounded-lg bg-blue-900/70 border border-white/10 flex items-center justify-center text-xs" data-side="WALA" data-market="2-3">0</button>
          </div>

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

      <div class="text-center text-yellow-400 font-bold text-lg mb-2"></div>

      <!-- 🔁 LOGROHAN (3D look, flatten on hover; now with numbers) -->
      <div class="bg-gray-900/50 border border-white/10 rounded-lg p-2 logro-zone">
        <div class="flex items-center justify-between mb-1">
          <div class="text-[11px] uppercase tracking-widest text-white/70">Logrohan</div>
          <div class="flex items-center gap-2 text-[10px]">
            <div class="flex items-center gap-1"><span class="logro-chip red"></span><span class="opacity-70">Meron</span></div>
            <div class="flex items-center gap-1"><span class="logro-chip blue"></span><span class="opacity-70">Wala</span></div>
          </div>
        </div>

        <!-- 3D Rail -->
        <div id="logro-rail" class="logro-rail">
          <div id="logro-strip" class="logro-strip-3d"></div>
        </div>
      </div>
      <!-- END LOGROHAN -->

    </div>

    <!-- Right Slideshow -->
    <div class="hidden md:block w-48 h-[600px] side-panel rounded-lg overflow-hidden relative">
      <img id="right-slide" class="w-full h-full object-cover transition-all duration-700" src="" alt="slide">
    </div>
  </div>

  <script>
    const players = ["Efren Reyes","Earl Strickland","Ronnie O'Sullivan","Shane Van Boening","Francisco Bustamante","Alex Pagulayan","Jeanette Lee","Karen Corr","Allison Fisher","Johnny Archer","Mika Immonen","Niels Feijen","Darren Appleton","Ko Pin-Yi","Wu Jiaqing"];
    const slides = ["https://i.ibb.co/jPjC9YqC/raga.jpg","https://i.ibb.co/fd26jLNQ/de-luna.webp","https://i.ibb.co/TBS7P8Cd/mika.jpg","https://i.ibb.co/4nMYxQFp/biado.jpg","https://i.ibb.co/7dSvjwRK/amoroto.jpg","https://i.ibb.co/Q7cQ30tS/efren.webp"];
    let slideIndex=0;
    function updateSlides(){ document.getElementById("left-slide").src=slides[slideIndex]; document.getElementById("right-slide").src=slides[(slideIndex+3)%slides.length]; slideIndex=(slideIndex+1)%slides.length; }
    setInterval(updateSlides,3000);

    /* ======= MATCHES DATA (strip + loader) ======= */
    const MATCH_COUNT = 40;
    let matches = [];
    function getRandomPlayer(exclude){
      let name;
      do{ name = players[Math.floor(Math.random()*players.length)]; } while(name===exclude);
      return name;
    }
    function genMatches(n=MATCH_COUNT){
      const list = [];
      for(let i=1;i<=n;i++){
        const red = getRandomPlayer();
        const blue = getRandomPlayer(red);
        list.push({ id:i, red, blue });
      }
      return list;
    }
    function renderMatchesStrip(){
      const strip = document.getElementById('matches-strip');
      strip.innerHTML = '';
      matches.forEach(m=>{
        const btn = document.createElement('button');
        btn.className = 'matches-pill px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/15 text-xs';
        btn.dataset.matchId = m.id;
        btn.innerHTML = `<b>#${m.id}</b> ${m.red.split(' ')[0]} vs ${m.blue.split(' ')[0]}`;
        btn.addEventListener('click', ()=> setCurrentMatch(m.id));
        strip.appendChild(btn);
      });
    }
    function setCurrentMatch(id){
      const m = matches.find(x=>x.id===id) || matches[0];
      document.getElementById('match-no').textContent = m.id;
      document.getElementById('player1-name').textContent = m.red;
      document.getElementById('player2-name').textContent = m.blue;
      // highlight active pill
      document.querySelectorAll('#matches-strip .matches-pill').forEach(p=>{
        p.classList.toggle('active', Number(p.dataset.matchId)===m.id);
      });
    }

    /* ======= LOGROHAN GENERATOR (R/B only, depth stack -> 3D) ======= */
    function genLogrohan(cols = 48){
      const out = [];
      for(let i=0;i<cols;i++){
        const depth = Math.floor(Math.random()*4)+1; // 1–4 height
        const col = [];
        for(let d=0; d<depth; d++){
          const t = Math.random() < 0.5 ? 'R' : 'B'; // R or B only
          col.push({ t, z:d }); // index for Z
        }
        out.push(col);
      }
      return out;
    }
    function bubbleClass(t){ return t==='R' ? 'logro-red' : 'logro-blue'; }

    // ✅ Numbered bubbles
    function renderLogrohan(data){
      const strip = document.getElementById('logro-strip');
      strip.innerHTML = '';
      let seq = 1; // running number sa loob ng bilog
      data.forEach(col=>{
        const colDiv = document.createElement('div');
        colDiv.className = 'logro-col';
        col.forEach(cell=>{
          const b = document.createElement('div');
          b.className = `logro-bubble ${bubbleClass(cell.t)} mb-[2px]`;
          b.style.setProperty('--z', `calc(var(--logro-step) * ${cell.z})`);
          b.style.transform = `translateZ(var(--z))`;
          b.title = (cell.t === 'R' ? 'Meron' : 'Wala') + ` • #${seq}`;
          b.textContent = seq; // <-- number sa loob
          colDiv.appendChild(b);
          seq++;
        });
        strip.appendChild(colDiv);
      });
    }

    /* ===== Rest of app ===== */
    let player1, player2, meronAmount, walaAmount, meronOdds, walaOdds;
    let pickedMarket="10-10";

    function getRandomAmount(){ return Math.floor(Math.random()*(50000-10000+1))+10000; }

    function setDateTime(){
      const now=new Date();
      const optionsDate={month:'2-digit', day:'2-digit', year:'numeric'};
      const optionsTime={weekday:'short', hour:'2-digit', minute:'2-digit', second:'2-digit', hour12:true};
      document.getElementById('event-date').textContent="EVENT - "+now.toLocaleDateString('en-US',optionsDate);
      document.getElementById('event-time').textContent=now.toLocaleTimeString('en-US',optionsTime)+" ";
    }
    setInterval(setDateTime,1000);

    function computeOdds(){ meronOdds=(Math.random()*(2.0-1.5)+1.5).toFixed(2); walaOdds=(parseFloat(meronOdds)+0.20).toFixed(2); }
    function renderOddsEverywhere(){
      document.getElementById('meron-odds').textContent="PAYOUT = "+meronOdds;
      document.getElementById('wala-odds').textContent ="PAYOUT = "+walaOdds;
      document.getElementById('odds-meron-top').textContent=meronOdds;
      document.getElementById('odds-wala-top').textContent =walaOdds;
    }

    function attachTilt(el){
      const damp=6;
      el.addEventListener('mousemove',(e)=>{
        const r=el.getBoundingClientRect();
        const x=(e.clientX-r.left)/r.width;
        const y=(e.clientY-r.top)/r.height;
        const rx=(y-0.5)*damp, ry=(0.5-x)*damp;
        el.style.transform=`rotateX(${rx}deg) rotateY(${ry}deg) translateY(-6px)`;
      });
      el.addEventListener('mouseleave',()=>{ el.style.transform='rotateX(0) rotateY(0) translateY(0)'; });
    }

    window.onload=()=>{
      setDateTime();

      // Matches
      matches = genMatches(MATCH_COUNT);
      renderMatchesStrip();
      setCurrentMatch(29); // default like your label

      // Random pool amounts
      meronAmount=getRandomAmount(); walaAmount=getRandomAmount();
      computeOdds(); renderOddsEverywhere();
      document.getElementById('meron-amount').textContent=meronAmount.toLocaleString();
      document.getElementById('wala-amount').textContent=walaAmount.toLocaleString();

      updateSlides();

      document.querySelectorAll('.tilt').forEach(attachTilt);

      const betArea=document.getElementById('bet-area');
      const oddsPanel=document.getElementById('odds-panel');
      betArea.style.display='grid'; oddsPanel.classList.add('hidden');
      document.getElementById('btn-odds').addEventListener('click',()=>{ betArea.style.display='none'; oddsPanel.classList.remove('hidden'); });
      document.getElementById('btn-totalizator').addEventListener('click',()=>{ oddsPanel.classList.add('hidden'); betArea.style.display='grid'; });

      document.querySelectorAll('.bet-target').forEach(btn=>{
        btn.addEventListener('click',()=>{
          pickedMarket=btn.dataset.market; updatePickedMarket(pickedMarket);
          const side=btn.dataset.side; betFromOdds(side,pickedMarket);
        });
      });
      document.getElementById('btn-bet-meron').addEventListener('click',()=>betFromOdds('MERON',pickedMarket));
      document.getElementById('btn-bet-wala').addEventListener('click',()=>betFromOdds('WALA',pickedMarket));
      document.getElementById('btn-reset').addEventListener('click',()=>{ pickedMarket='10-10'; updatePickedMarket(pickedMarket); document.getElementById('odds-amount').value=50; });

      updatePickedMarket(pickedMarket);

      const bigBalanceEl=document.querySelector('.text-center.text-yellow-400.font-bold.text-lg.mb-2');
      if(bigBalanceEl){
        const match=bigBalanceEl.textContent.match(/BALANCE:\s*([\d.,]+)/i);
        if(match) document.getElementById('header-balance').textContent=match[1];
      }
      const name='AMOK';
      document.getElementById('account-name').textContent=name;
      document.getElementById('account-name-menu').textContent=name;

      const btn=document.getElementById('account-btn');
      const menu=document.getElementById('account-menu');
      btn.addEventListener('click',()=>{ menu.classList.toggle('hidden'); });
      document.addEventListener('click',(e)=>{ if(!btn.contains(e.target)&&!menu.contains(e.target)) menu.classList.add('hidden'); });

      // render logrohan (3D look) with numbers
      renderLogrohan(genLogrohan(48));
      // NOTE: Hover lang ang nagfa-flatten; walang draw; may numbers na sa loob ng bilog.
    };

    function updatePickedMarket(mkt){
      const [a,b]=mkt.split('-');
      document.getElementById('picked-a').textContent=a+"-";
      document.getElementById('picked-b').textContent=b;
    }

    function betFromOdds(side, market){
      const amt=parseFloat(document.getElementById('odds-amount').value);
      if(isNaN(amt)||amt<=0){ alert('Please enter a valid amount.'); return; }
      const odds= side==='MERON'? meronOdds : walaOdds;
      const payout=(amt*parseFloat(odds)).toFixed(2);
      alert(`ODDS BET: ${side} @ ${market}\nAmount: ${amt}\nPossible payout: ${payout}`);
    }

    function placeBet(betType){
      let betAmount = betType==='MERON'? document.getElementById('meron-bet').value : document.getElementById('wala-bet').value;
      let odds = betType==='MERON'? meronOdds : walaOdds;
      let chosenPlayer = betType==='MERON'? document.getElementById('player1-name').textContent : document.getElementById('player2-name').textContent;
      if(betAmount===""||betAmount<=0){ alert("Please enter a valid bet amount."); return; }
      let totalWinnings = parseFloat(betAmount)*odds;
      if(betType==='MERON'){ document.getElementById('meron-result').textContent = `${chosenPlayer} Winnings: ${totalWinnings.toFixed(2)}`; }
      else { document.getElementById('wala-result').textContent = `${chosenPlayer} Winnings: ${totalWinnings.toFixed(2)}`; }
      alert(`You placed a bet of ${betAmount} on ${chosenPlayer}. Possible payout: ${totalWinnings.toFixed(2)}.`);
    }

    function loadYouTubeVideo(){
      const link=document.getElementById("youtube-link").value;
      if(!link){ alert("Please paste a YouTube link."); return; }
      let videoId=""; 
      try{
        const url=new URL(link);
        if(url.hostname.includes("youtube.com")) videoId=url.searchParams.get("v");
        else if(url.hostname.includes("youtu.be")) videoId=url.pathname.slice(1);
      }catch(e){}
      if(videoId){ document.getElementById("youtube-video").src=`https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1`; }
      else alert("Invalid YouTube link.");
    }
  </script>
</body>
</html>
