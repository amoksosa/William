<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Turbo Letters • Rainbow Background</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ["Poppins","ui-sans-serif","system-ui"] },
          backgroundImage: {
            starfield:
              "radial-gradient(1200px 600px at 50% 20%, rgba(255,255,255,.08), rgba(0,0,0,0)), radial-gradient(900px 460px at 50% 35%, rgba(255,255,255,.06), rgba(0,0,0,0))",
          },
          keyframes: {
            ringSpin: { "0%": { transform: "rotateY(0) rotateX(25deg)" }, "100%": { transform: "rotateY(360deg) rotateX(25deg)" } },
            cubeSpin: { "0%": { transform: "rotateX(-10deg) rotateY(0deg)" }, "100%": { transform: "rotateX(-10deg) rotateY(360deg)" } },
            flipIn:   { "0%": { transform: "rotateX(90deg)", opacity:.0 }, "100%": { transform: "rotateX(0)", opacity:1 } },
            twinkle:  { "0%,100%": { opacity:.15 }, "50%": { opacity:.55 } },
            sweep:    { "0%": { transform:"translateX(-30%)" }, "100%": { transform:"translateX(30%)" } },
            bob:      { "0%": { transform:"translateY(0) rotateX(-10deg)" }, "50%": { transform:"translateY(-6px) rotateX(-10deg)" }, "100%": { transform:"translateY(0) rotateX(-10deg)" } },
            shine:    { "0%": { transform:"translateX(-140%) rotate(12deg)" }, "100%": { transform:"translateX(140%) rotate(12deg)" } },
            spin360:  { "0%": { transform:"rotate(0deg)" }, "100%": { transform:"rotate(360deg)" } },
            flow:     { "0%": { backgroundPosition:"0% 50%" }, "100%": { backgroundPosition:"400% 50%" } },
            hueCycle: { "0%": { filter:"hue-rotate(0deg)" }, "100%": { filter:"hue-rotate(360deg)" } },
            popGlow:  { "0%,100%": { textShadow: "0 2px 0 rgba(0,0,0,.35), 0 6px 12px rgba(0,0,0,.35), 0 0 22px rgba(255,255,255,.18)" },
                        "50%": { textShadow: "0 2px 0 rgba(0,0,0,.35), 0 10px 18px rgba(0,0,0,.5), 0 0 34px rgba(255,255,255,.42)" } }
          },
          animation: {
            ringSpin: "ringSpin 14s linear infinite",
            cubeSpin: "cubeSpin 10s linear infinite",
            flipIn:   "flipIn .35s cubic-bezier(.2,.8,.2,1)",
            twinkle:  "twinkle 3.2s ease-in-out infinite",
            sweep:    "sweep 18s ease-in-out infinite alternate",
            bob:      "bob 3.6s ease-in-out infinite",
            shine:    "shine .3s ease-out 1",
            rainbowSpin: "spin360 4s linear infinite",
            rainbowFlow: "flow 2.2s linear infinite",
            hueCycle: "hueCycle 2s linear infinite",
            popGlow:  "popGlow 1.4s ease-in-out infinite"
          },
          boxShadow: { neon: "0 0 10px rgba(255,255,255,.75), 0 0 36px rgba(255,255,255,.28)" }
        }
      }
    }
  </script>
  <style>
    :root{ --accent:#ffd400; --lift:200px; }
    @media (prefers-reduced-motion: reduce) {
      * { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; scroll-behavior: auto !important; }
    }
    .neon-accent{ color:var(--accent); text-shadow:0 0 8px rgba(255,212,0,.95),0 0 22px rgba(255,212,0,.55),0 0 44px rgba(255,212,0,.35); }
    .scene{ perspective:1200px; } .preserve{ transform-style:preserve-3d; }
    .lift{ transform: translateY(calc(-1 * var(--lift))); will-change: transform; }
    .jackpot-font{ font-family:"Bungee","Poppins","ui-sans-serif","system-ui"; }
    .rainbow-letter{ display:inline-block; background:linear-gradient(90deg,#ff0040,#ff7a00,#ffd400,#a4ff00,#00ffd5,#00a2ff,#7a00ff,#ff00e1,#ff0040); background-size:400% 100%; -webkit-background-clip:text; background-clip:text; color:transparent!important; animation:flow 1.1s linear infinite,hueCycle 2s linear infinite,popGlow 1.4s ease-in-out infinite; }

    .ring3d{ position:relative; isolation:isolate; filter: drop-shadow(0 14px 40px rgba(0,0,0,.45)); }
    .ring3d::before,.ring3d::after{
      content:""; position:absolute; inset:0; border-radius:100%;
      background:
        radial-gradient(closest-side, rgba(255,255,255,.85), rgba(255,255,255,0) 60%),
        conic-gradient(from 0deg, rgba(255,0,80,.75), rgba(255,170,0,.75), rgba(255,240,0,.75), rgba(0,255,170,.75), rgba(0,160,255,.75), rgba(150,0,255,.75), rgba(255,0,225,.75), rgba(255,0,80,.75));
      mix-blend-mode: screen; opacity:.45;
      mask: radial-gradient(closest-side, transparent 58%, #000 60%, #000 75%, transparent 77%);
    }
    .ring3d::after{ filter: blur(6px) saturate(1.1); opacity:.6; }

    .pill3d{ position:relative; overflow:hidden; border-radius:999px; box-shadow: inset 0 0 0 1px rgba(255,255,255,.35), 0 18px 40px rgba(0,0,0,.35); }
    .pill3d::before{ content:""; position:absolute; inset:-20% -120%; transform:rotate(12deg); background: linear-gradient(90deg, rgba(255,255,255,.0) 0%, rgba(255,255,255,.55) 50%, rgba(255,255,255,.0) 100%); animation: shine .9s ease-out paused; }
    .pill3d:hover::before { animation-play-state: running; }
    .shadow-neon{ box-shadow:0 0 20px rgba(255,255,255,.25), 0 0 60px rgba(255,255,255,.15); }

    /* LEFT CSS cubes */
    .cube{ --front:#5eead4; --side:#2dd4bf; --top:#99f6e4; --tile:#e6fffb; --text:#111827; --wire:rgba(255,255,255,.12);
      position:relative; width:7rem; height:7rem; transform-style:preserve-3d; transition: box-shadow .35s ease, transform .3s ease; animation: bob 3.6s ease-in-out infinite; }
    .cube::after{ content:""; position:absolute; left:50%; top:100%; width:76%; height:30px; transform:translate(-50%,-6px) rotateX(75deg); background:radial-gradient(50% 100% at 50% 0%, rgba(0,0,0,.35), transparent 70%); filter:blur(6px); }
    .face{ position:absolute; inset:0; display:flex; align-items:center; justify-content:center; backface-visibility:hidden; border-radius:.6rem; outline:1px solid var(--wire); background-image: linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%), linear-gradient(to bottom right, var(--front), var(--side)); }
    .face.front{transform:translateZ(56px);} .face.back{transform:rotateY(180deg) translateZ(56px);} .face.right{transform:rotateY(90deg) translateZ(56px);} .face.left{transform:rotateY(-90deg) translateZ(56px);}
    .face.top{ transform:rotateX(90deg) translateZ(56px); border-radius:.6rem .6rem .45rem .45rem; background-image:linear-gradient(180deg, rgba(255,255,255,.22), rgba(255,255,255,0) 50%), linear-gradient(to bottom, var(--top), var(--front)); }
    .face.bottom{ transform:rotateX(-90deg) translateZ(56px); background-image:linear-gradient(0deg, #0b1022, #0f172a); }
    .tile{ position:relative; width:58%; height:58%; border-radius:.55rem; display:flex; align-items:center; justify-content:center; background:var(--tile); color:var(--text);
      box-shadow:0 6px 14px rgba(0,0,0,.25), inset 0 0 6px rgba(255,255,255,.45); font-weight:900; font-size:1.9rem; letter-spacing:.02em; transform:translateZ(1px); text-shadow: 0 1px 0 rgba(255,255,255,.25), 0 2px 0 rgba(255,255,255,.12); }

    .bg-grid{ background-image:linear-gradient(rgba(255,255,255,0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px); background-size:36px 36px, 36px 36px; mask-image:radial-gradient(90% 70% at 50% 30%, #000 70%, transparent 100%); }
    .bg-aurora{ background:radial-gradient(60% 90% at 0% 10%, rgba(255,255,255,.10), transparent 60%), radial-gradient(60% 90% at 100% 0%, rgba(255,255,255,.10), transparent 60%), radial-gradient(100% 80% at 50% 100%, rgba(255,255,255,.08), transparent 60%); filter:blur(.6px); }
    .rainbow-stack { position:fixed; inset:0; pointer-events:none; z-index:0; }
    .rainbow-stack::before{ content:""; position:absolute; inset:-20%; background:conic-gradient(from 0deg,#ff0040,#ff7a00,#ffd400,#a4ff00,#00ffd5,#00a2ff,#7a00ff,#ff00e1,#ff0040); filter:blur(26px) saturate(1.2); animation:rainbowSpin 4s linear infinite; mix-blend-mode:screen; opacity:.55; border-radius:50%; }
    .rainbow-stack::after{ content:""; position:absolute; inset:-10%; background:linear-gradient(90deg,rgba(255,0,64,.65) 0%,rgba(255,122,0,.65) 14%,rgba(255,212,0,.65) 28%,rgba(164,255,0,.65) 42%,rgba(0,255,213,.65) 56%,rgba(0,162,255,.65) 70%,rgba(122,0,255,.65) 84%,rgba(255,0,225,.65) 100%); background-size:400% 100%; animation:rainbowFlow 2.2s linear infinite; filter:blur(32px); mix-blend-mode:screen; opacity:.38; }

    #confetti { position: fixed; inset: 0; z-index: 30; pointer-events: none; }
    #amount .digit{ transition: color .18s linear, text-shadow .18s linear, filter .18s linear; }
    .cube[data-active="true"]{ animation-play-state: paused; /* visual state handled inline during pause */ }

    .main-grid{ display:grid; grid-template-columns:1fr 540px; gap:1.8rem; align-items:start; }
    .main-grid>*{ margin:0!important; text-align:left; }
    .main-grid .original-jackpot-content{ display:flex; flex-direction:column; align-items:center; text-align:center; }
    .main-grid .original-jackpot-content section{ text-align:center; width:100%; }

    .game-board-outer{ margin-top:0; display:flex; justify-content:center; align-self:start; }
    .game-board-container{
      width:100%; max-width:520px;
      background:linear-gradient(180deg, rgba(255,255,255,.85), rgba(255,255,255,.78));
      border:1px solid rgba(255,255,255,.55);
      border-radius:1rem; padding:1rem;
      backdrop-filter: blur(10px) saturate(1.1);
      box-shadow: 0 24px 60px rgba(0,0,0,.45), inset 0 0 0 1px rgba(255,255,255,.35), 0 0 24px rgba(255,255,255,.06);
      margin-left:2.4rem;
      transform-origin: top center;
    }

    #tjs * { box-sizing:border-box; }
    #tjs .title{ display:none; }
    #tjs #canvas-container{
      width:100%; height:380px; min-height:260px; position:relative; margin:0 0 8px 0; border-radius:14px; overflow:hidden;
      background:
        radial-gradient(800px 400px at 30% 20%, rgba(255,255,255,.06), rgba(255,255,255,0)),
        radial-gradient(600px 320px at 80% 40%, rgba(255,255,255,.05), rgba(255,255,255,0));
      outline: 1px solid rgba(0,0,0,.06); box-shadow: inset 0 0 0 1px rgba(255,255,255,.25);
    }

    #tjs .controls{
      position:relative; display:flex; flex-direction:column; align-items:center; width:100%; max-width:800px; padding:12px;
      margin-top:-22px; gap:10px;
    }
    @media (max-width:1024px){ #tjs .controls{ margin-top:-14px; } }
    @media (max-width:768px){  #tjs .controls{ margin-top:-10px; } }

    .glass-card{
      border-radius:16px;
      border:1.5px solid rgba(0,0,0,.10);
      background:linear-gradient(180deg, rgba(255,255,255,.68), rgba(255,255,255,.48));
      box-shadow: 0 10px 26px rgba(0,0,0,.12), inset 0 0 0 1px rgba(255,255,255,.22);
      backdrop-filter: blur(8px) saturate(1.1);
    }

    #tjs .color-selection{ width:100%; max-width:600px; padding:12px 14px 14px; }
    #tjs .color-selection.glass-card{ box-shadow: 0 14px 30px rgba(0,0,0,.12), inset 0 0 0 1px rgba(255,255,255,.22); }
    #tjs .color-title{ text-align:center; font-size:clamp(1rem,3vw,1.2rem); margin-bottom:10px; color:#0f172a; font-weight:900; letter-spacing:.02em; text-shadow: 0 1px 0 rgba(255,255,255,.55); }
    #tjs .color-grid{ display:grid; grid-template-columns:repeat(6,1fr); gap:10px; margin-bottom:2px; }
    #tjs .color-btn{
      width:100%; height:44px; border:none; border-radius:12px; cursor:pointer; transition:transform .18s ease, box-shadow .18s ease, outline-color .18s ease, filter .12s ease;
      position:relative; touch-action:manipulation; -webkit-tap-highlight-color:transparent; box-shadow:0 2px 8px rgba(0,0,0,.12); outline:2px solid transparent; outline-offset:2px; filter:saturate(1.05);
    }
    #tjs .color-btn:hover:not(.selected){ transform:translateY(-1px) scale(1.03); box-shadow:0 6px 16px rgba(0,0,0,.18); }
    #tjs .color-btn.selected{ box-shadow:0 0 0 3px rgba(0,0,0,.25) inset, 0 6px 16px rgba(0,0,0,.22); transform:scale(1.05); outline-color: rgba(0,0,0,.25); }
    #tjs .color-btn::after{ content:'✓'; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:#fff; font-size:1.1em; font-weight:800; text-shadow:0 0 6px rgba(0,0,0,.65); opacity:0; transition:opacity .18s; }
    #tjs .color-btn.selected::after{ opacity:1; }

    #tjs .letters-grid{ display:grid; grid-template-columns:repeat(auto-fit, minmax(42px,1fr)); gap:8px; width:100%; max-width:600px; }
    #tjs .letter-btn{
      height:42px; background:rgba(0,0,0,0.06); border:none; border-radius:12px; color:#0f172a;
      font-size:clamp(.95rem,3vw,1.05rem); font-weight:900; cursor:pointer;
      transition:transform .12s ease, box-shadow .12s ease, background .12s ease, outline-color .12s ease; box-shadow:0 4px 10px rgba(0,0,0,.07); outline:2px solid transparent; outline-offset:2px;
    }
    #tjs .letter-btn:hover:not(:disabled), #tjs .letter-btn:active:not(:disabled){ background:rgba(0,0,0,0.12); transform:translateY(-1px) scale(1.03); box-shadow:0 8px 18px rgba(0,0,0,.12); }
    #tjs .letter-btn:focus-visible{ outline-color:#0ea5e9; }
    #tjs .letter-btn:disabled{ opacity:.38; cursor:not-allowed; }

    #tjs .info-panel{ gap:10px; align-items:center; padding:12px; width:100%; max-width:460px; }
    #tjs .info-panel.glass-card{ background:linear-gradient(180deg, rgba(255,255,255,.64), rgba(255,255,255,.48)); }
    #tjs .btn-row{ display:flex; gap:10px; flex-wrap:wrap; justify-content:center; }
    .btn{ padding:10px 18px; border:none; border-radius:12px; color:#fff; font-weight:900; font-size:1rem; cursor:pointer; transition:transform .15s ease, box-shadow .15s ease, filter .15s ease; min-height:40px; }
    .btn:hover{ transform: translateY(-1px) scale(1.02); filter: brightness(1.05); }
    .btn:active{ transform: translateY(0); }
    .btn-play{ background:#10b981; box-shadow: 0 10px 24px rgba(16,185,129,.25); }
    .btn-lucky{ background:#f59e0b; box-shadow: 0 10px 24px rgba(245,158,11,.25); }
    .btn-clear{ background:#ff3b30; box-shadow: 0 10px 24px rgba(255,59,48,.25); }
    #tjs .status{ color:#0f172a; font-size:clamp(1rem,4vw,1.05rem); font-weight:900; letter-spacing:.02em; }

    #tjs .history-panel{ width:100%; max-width:460px; padding:12px; position:relative; }
    #tjs .history-panel.glass-card{ background:linear-gradient(180deg, rgba(255,255,255,.66), rgba(255,255,255,.50)); }
    #tjs .history-title{
      font-weight:900; color:#0f172a; text-shadow:0 1px 0 rgba(255,255,255,.55);
      font-size:clamp(1rem,3vw,1.1rem); margin-bottom:8px; text-align:center;
    }
    #tjs .history-list{
      list-style:none; padding:0; margin:0;
      display:flex; flex-direction:column; gap:8px; max-height:200px; overflow:auto;
      scrollbar-width: thin; scrollbar-color: rgba(2,6,23,.3) transparent;
    }
    #tjs .history-list::-webkit-scrollbar{ height:8px; width:8px; }
    #tjs .history-list::-webkit-scrollbar-thumb{ background:rgba(2,6,23,.28); border-radius:8px; }
    #tjs .history-item{
      display:flex; align-items:center; gap:12px; padding:10px 12px; border-radius:12px;
      background:rgba(255,255,255,.72); border:1px solid rgba(0,0,0,.06);
      transition: transform .12s ease, box-shadow .12s ease;
    }
    #tjs .history-item:hover{ transform: translateY(-1px); box-shadow:0 10px 20px rgba(0,0,0,.08); }
    #tjs .history-item .swatch{ width:18px; height:18px; border-radius:6px; box-shadow:0 0 0 1px rgba(0,0,0,.18) inset; }
    #tjs .history-meta{ display:flex; flex-direction:column; gap:2px; }
    #tjs .history-letters{ font-weight:900; color:#0f172a; letter-spacing:.2em; }
    #tjs .history-sub{ font-size:.82rem; color:#334155; font-weight:700; opacity:.9; }

    @media (max-width:1024px){
      .main-grid{ grid-template-columns:1fr; gap:1.2rem; }
      .game-board-container{ margin-left:0; }
    }
    @media (max-width:768px){
      #tjs #canvas-container{ height:340px; }
      #tjs .color-grid{ grid-template-columns:repeat(4,1fr); }
      #tjs .letters-grid{ grid-template-columns:repeat(6,1fr); }
    }
    @media (max-width:480px){
      #tjs #canvas-container{ height:300px; }
      #tjs .color-grid{ grid-template-columns:repeat(3,1fr); }
      #tjs .letter-btn{ height:38px; font-size:.95rem; border-radius:10px; }
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Bungee:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
</head>
<body class="min-h-dvh bg-[#070b16] bg-starfield text-white font-display overflow-hidden relative">
  <canvas id="confetti" class="lift"></canvas>
  <div class="rainbow-stack"></div>

  <div class="pointer-events-none fixed inset-0 -z-0">
    <div class="absolute inset-0 mix-blend-screen">
      <div class="absolute top-10 left-[12%] size-2 rounded-full bg-white/70 animate-twinkle"></div>
      <div class="absolute top-[18%] right-[18%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:.8s]"></div>
      <div class="absolute top-[34%] left-[22%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:1.6s]"></div>
      <div class="absolute top-[42%] right-[28%] size-2 rounded-full bg-white/70 animate-twinkle [animation-delay:2.2s]"></div>
      <div class="absolute bottom-[22%] left-[36%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:2.8s]"></div>
    </div>
    <div class="absolute inset-0 mix-blend-screen"><div class="bg-grid absolute inset-0 opacity-[.38]"></div></div>
    <div class="absolute inset-0 bg-aurora"></div>
  </div>

  <main class="main-grid relative z-10 max-w-7xl mx-auto px-5 md:px-10 pt-14 md:pt-20 pb-12 scene lift">
    <!-- LEFT -->
    <div class="original-jackpot-content">
      <div class="relative h-44 md:h-56 preserve">
        <div class="ring3d absolute left-1/2 -translate-x-1/2 top-2 w-[88%] md:w-[78%] aspect-[2.4/1] animate-ringSpin" style="transform: rotateX(25deg) translateZ(0)"></div>
      </div>

      <section class="text-center preserve">
        <img id="wilyLogo"
          src="https://i.ibb.co/6RcL2yRP/logo-ezgif-com-crop.gif"
          alt="WILYONARYO"
          class="mx-auto mb-2 md:mb-3 h-[clamp(2.4rem,6.6vw,5.6rem)] w-auto drop-shadow-[0_6px_18px_rgba(0,0,0,.45)]"/>
        <h1 id="jackpot" class="jackpot-font text-[clamp(2rem,6vw,5rem)] leading-none font-extrabold tracking-[.08em]">JACKPOT</h1>
        <h2 id="prize"   class="jackpot-font text-[clamp(1.6rem,5vw,3.8rem)] -mt-1 font-extrabold tracking-[.32em]">PRIZE</h2>

        <div class="mt-6 md:mt-8 inline-flex items-center gap-3 rounded-[3rem] px-7 md:px-9 py-4 md:py-5 bg-white/8 border border-white/25 backdrop-blur-sm pill3d shadow-neon">
          <span class="neon-accent text-[clamp(1.3rem,3.6vw,2.4rem)] font-extrabold">₱</span>
          <span id="amount" class="text-[clamp(1.9rem,5.5vw,3.3rem)] font-extrabold tabular-nums tracking-wider">6,000,000</span>
          <span class="ml-2 inline-block w-3 h-3 rounded-full border border-white/60 shadow-neon"></span>
        </div>
        <p class="mt-3 text-white/70 text-sm">This might be your lucky day!</p>
      </section>

      <!-- TIMER -->
      <div class="mt-6 md:mt-8">
        <div class="mx-auto w-fit px-6 py-3 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm shadow-neon">
          <span id="cycleTimer" class="rainbow-letter font-extrabold tracking-widest text-[clamp(1.25rem,4.8vw,2.4rem)]">03:00</span>
        </div>
        <div id="timerSub" class="mt-2 text-xs md:text-sm text-white/70">Next stop in <span class="font-bold">3:00</span></div>
      </div>

      <section class="mt-6 md:mt-8 preserve">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 place-items-center">
          <div class="cube animate-cubeSpin [animation-duration:11s]" data-cube>
            <div class="face front"><div class="tile" data-letter></div></div>
            <div class="face back"><div class="tile" data-letter></div></div>
            <div class="face right"><div class="tile" data-letter></div></div>
            <div class="face left"><div class="tile" data-letter></div></div>
            <div class="face top"><div class="tile" data-letter></div></div>
            <div class="face bottom"><div class="tile" data-letter></div></div>
          </div>
          <div class="cube animate-cubeSpin [animation-delay:.2s]" data-cube>
            <div class="face front"><div class="tile" data-letter></div></div>
            <div class="face back"><div class="tile" data-letter></div></div>
            <div class="face right"><div class="tile" data-letter></div></div>
            <div class="face left"><div class="tile" data-letter></div></div>
            <div class="face top"><div class="tile" data-letter></div></div>
            <div class="face bottom"><div class="tile" data-letter></div></div>
          </div>
          <div class="cube animate-cubeSpin [animation-delay:.4s] [animation-duration:12s]" data-cube>
            <div class="face front"><div class="tile" data-letter></div></div>
            <div class="face back"><div class="tile" data-letter></div></div>
            <div class="face right"><div class="tile" data-letter></div></div>
            <div class="face left"><div class="tile" data-letter></div></div>
            <div class="face top"><div class="tile" data-letter></div></div>
            <div class="face bottom"><div class="tile" data-letter></div></div>
          </div>
          <div class="cube animate-cubeSpin [animation-delay:.6s] [animation-duration:9.5s]" data-cube>
            <div class="face front"><div class="tile" data-letter></div></div>
            <div class="face back"><div class="tile" data-letter></div></div>
            <div class="face right"><div class="tile" data-letter></div></div>
            <div class="face left"><div class="tile" data-letter></div></div>
            <div class="face top"><div class="tile" data-letter></div></div>
            <div class="face bottom"><div class="tile" data-letter></div></div>
          </div>
        </div>
      </section>

      <div class="mt-14 h-20 relative">
        <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-white/20"></div>
        <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-white/16"></div>
      </div>
    </div>

    <!-- RIGHT (unchanged) -->
    <div class="game-board-outer">
      <div id="gameBoard" class="game-board-container">
        <div id="tjs">
          <div class="title"><img src="https://wilyonaryo.com/themes/images/logo/logo.gif" height="120" alt=""></div>
          <div id="canvas-container"></div>

          <div class="controls">
            <div class="color-selection glass-card">
              <div class="color-title"></div>
              <div class="color-grid">
                <div class="color-btn" style="background:#ff6b6b" onclick="selectColor(0,0xff6b6b)"></div>
                <div class="color-btn" style="background:#4ecdc4" onclick="selectColor(1,0x4ecdc4)"></div>
                <div class="color-btn" style="background:#45b7d1" onclick="selectColor(2,0x45b7d1)"></div>
                <div class="color-btn" style="background:#ffa726" onclick="selectColor(3,0xffa726)"></div>
                <div class="color-btn" style="background:#ab47bc" onclick="selectColor(4,0xab47bc)"></div>
                <div class="color-btn" style="background:#66bb6a" onclick="selectColor(5,0x66bb6a)"></div>
                <div class="color-btn" style="background:#ef5350" onclick="selectColor(6,0xef5350)"></div>
                <div class="color-btn selected" style="background:#42a5f5" onclick="selectColor(7,0x42a5f5)"></div>
                <div class="color-btn" style="background:#ff7043" onclick="selectColor(8,0xff7043)"></div>
                <div class="color-btn" style="background:#ec407a" onclick="selectColor(9,0xec407a)"></div>
                <div class="color-btn" style="background:#26c6da" onclick="selectColor(10,0x26c6da)"></div>
                <div class="color-btn" style="background:#d4e157" onclick="selectColor(11,0xd4e157)"></div>
              </div>
            </div>

            <div class="letters-grid">
              <!-- A-Z buttons -->
              <button class="letter-btn" onclick="selectLetter('A')">A</button>
              <button class="letter-btn" onclick="selectLetter('B')">B</button>
              <button class="letter-btn" onclick="selectLetter('C')">C</button>
              <button class="letter-btn" onclick="selectLetter('D')">D</button>
              <button class="letter-btn" onclick="selectLetter('E')">E</button>
              <button class="letter-btn" onclick="selectLetter('F')">F</button>
              <button class="letter-btn" onclick="selectLetter('G')">G</button>
              <button class="letter-btn" onclick="selectLetter('H')">H</button>
              <button class="letter-btn" onclick="selectLetter('I')">I</button>
              <button class="letter-btn" onclick="selectLetter('J')">J</button>
              <button class="letter-btn" onclick="selectLetter('K')">K</button>
              <button class="letter-btn" onclick="selectLetter('L')">L</button>
              <button class="letter-btn" onclick="selectLetter('M')">M</button>
              <button class="letter-btn" onclick="selectLetter('N')">N</button>
              <button class="letter-btn" onclick="selectLetter('O')">O</button>
              <button class="letter-btn" onclick="selectLetter('P')">P</button>
              <button class="letter-btn" onclick="selectLetter('Q')">Q</button>
              <button class="letter-btn" onclick="selectLetter('R')">R</button>
              <button class="letter-btn" onclick="selectLetter('S')">S</button>
              <button class="letter-btn" onclick="selectLetter('T')">T</button>
              <button class="letter-btn" onclick="selectLetter('U')">U</button>
              <button class="letter-btn" onclick="selectLetter('V')">V</button>
              <button class="letter-btn" onclick="selectLetter('W')">W</button>
              <button class="letter-btn" onclick="selectLetter('X')">X</button>
              <button class="letter-btn" onclick="selectLetter('Y')">Y</button>
              <button class="letter-btn" onclick="selectLetter('Z')">Z</button>
            </div>

            <div class="info-panel glass-card">
              <div class="status" id="status">Selected: 0/4</div>
              <div class="btn-row">
                <button class="btn btn-play" onclick="playGame()">Play</button>
                <button class="btn btn-lucky" onclick="luckyPick()">Lucky Pick</button>
                <button class="btn btn-clear" onclick="clearBoxes()">Clear All</button>
              </div>
            </div>

            <div class="history-panel glass-card">
              <div class="history-title">Bet History</div>
              <ul id="betHistory" class="history-list"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- LEFT effects + amount ticker -->
  <script>
    let amount = 6000000;
    const amountEl = document.getElementById("amount");
    const peso = n => n.toLocaleString("en-PH");
    const wrapDigits = s => s.split("").map(ch=>`<span class="digit">${ch}</span>`).join("");
    function updatePrize(){ amountEl.innerHTML = wrapDigits(peso(amount)); }
    function tickPrize(){ amount += Math.floor(Math.random()*2000)+1; updatePrize(); }
    updatePrize(); setInterval(tickPrize, 5000);

    const letterTiles=[...document.querySelectorAll(".cube .tile[data-letter]")];
    const r=n=>Math.floor(Math.random()*n);
    window.__freezeCubes = false;

    function shuffle(){
      if (window.__freezeCubes) return;
      letterTiles.forEach(t=>{ t.textContent="ABCDEFGHIJKLMNOPQRSTUVWXYZ"[r(26)]; });
    }
    shuffle(); setInterval(shuffle,40);

    function alignAndFitRightPanel(){
      const panel = document.getElementById('gameBoard');
      const logo  = document.getElementById('wilyLogo');
      if(!panel || !logo) return;
      panel.style.transform = 'translateY(0px) scale(1)';
      const panelRect = panel.getBoundingClientRect();
      const logoRect  = logo.getBoundingClientRect();
      const shiftY = logoRect.top - panelRect.top;
      const viewportH = window.innerHeight;
      const available = viewportH - (panelRect.top + shiftY) - 16;
      const naturalH  = panelRect.height;
      let scale = 1;
      if (naturalH > available) scale = Math.max(0.6, available / naturalH);
      panel.style.transform = `translateY(${shiftY - 56}px) scale(${scale})`;
      panel.style.transformOrigin = 'top center';
    }
    window.addEventListener('load', alignAndFitRightPanel);
    window.addEventListener('resize', alignAndFitRightPanel);
    setTimeout(alignAndFitRightPanel, 200);

    const fastPalette = [
      "#ff6b6b","#4ecdc4","#45b7d1","#ffa726","#ab47bc","#66bb6a",
      "#ef5350","#42a5f5","#ff7043","#ec407a","#26c6da","#d4e157",
      "#f97316","#22c55e","#a855f7","#eab308","#06b6d4","#ef4444"
    ];
    function hexToHsl(hex){
      hex = hex.replace('#',''); if(hex.length===3){ hex=[...hex].map(x=>x+x).join(''); }
      const r = parseInt(hex.slice(0,2),16)/255, g = parseInt(hex.slice(2,4),16)/255, b = parseInt(hex.slice(4,6),16)/255;
      const max=Math.max(r,g,b), min=Math.min(r,g,b); let h,s,l=(max+min)/2;
      if(max===min){ h=s=0; } else { const d=max-min; s=l>0.5? d/(2-max-min): d/(max+min);
        switch(max){ case r: h=(g-b)/d+(g<b?6:0); break; case g: h=(b-r)/d+2; break; case b: h=(r-g)/d+4; break; } h/=6; }
      return {h,s,l};
    }
    function hslToHex(h,s,l){
      function f(n){ const k=(n+h*12)%12; const a=s*Math.min(l,1-l);
        const c=l - a*Math.max(-1,Math.min(k-3,Math.min(9-k,1)));
        return Math.round(255*c).toString(16).padStart(2,'0'); }
      return `#${f(0)}${f(8)}${f(4)}`;
    }
    function shade(hex, dl=0){ const {h,s,l}=hexToHsl(hex); const nl=Math.min(1,Math.max(0,l+dl)); return hslToHex(h,s,nl); }
    function applyLeftTheme(baseHex){
      const digits = amountEl.querySelectorAll('.digit');
      digits.forEach(d => {
        d.style.color = baseHex;
        d.style.textShadow = `0 2px 0 rgba(0,0,0,.35), 0 10px 18px rgba(0,0,0,.5), 0 0 28px ${baseHex}55`;
      });
      const cubesLeft = document.querySelectorAll('.original-jackpot-content .cube');
      const front = baseHex, side = shade(baseHex,-0.08), top = shade(baseHex,0.12), tile = shade("#ffffff",-0.08);
      cubesLeft.forEach(el=>{
        el.style.setProperty('--front', front);
        el.style.setProperty('--side', side);
        el.style.setProperty('--top', top);
        el.style.setProperty('--tile', tile);
      });
    }
    function spinLeftTheme(){
      if (window.__freezeCubes) return;
      const base = fastPalette[Math.floor(Math.random()*fastPalette.length)];
      applyLeftTheme(base);
    }
    setInterval(spinLeftTheme, 500);
    spinLeftTheme();

    /* ===== 3-MIN CYCLE TIMER WITH FACE-FRONT PAUSE ===== */
    const uiCubes = [...document.querySelectorAll('.original-jackpot-content .cube')];
    const cycleEl = document.getElementById('cycleTimer');
    const subEl   = document.getElementById('timerSub');

    const CYCLE_MS = 1*60*1000;
    const PAUSE_MS = 30*1000;
    let mode = 'spin';
    let remain = CYCLE_MS;
    let lastT = performance.now();

    function fmt(t){ const s=Math.max(0,Math.floor(t/1000)); const m=String(Math.floor(s/60)).padStart(2,'0'); const ss=String(s%60).padStart(2,'0'); return `${m}:${ss}`; }
    function setCubeLetter(i, ch){ uiCubes[i].querySelectorAll('[data-letter]').forEach(t=>t.textContent = ch); }

    function lockRandomLettersAndColor(){
      const A="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      const picks=new Set(); while(picks.size<4) picks.add(A[Math.floor(Math.random()*26)]);
      [...picks].forEach((ch,i)=>setCubeLetter(i,ch));
      const color=fastPalette[Math.floor(Math.random()*fastPalette.length)];
      applyLeftTheme(color);

      // Pause animations and FORCE FACE FRONT (rotateY(0deg))
      uiCubes.forEach(el=>{
        el.setAttribute('data-active','true');
        el.style.animationPlayState = 'paused';
        el.style.transform = 'translateY(-4px) rotateX(-8deg) rotateY(0deg) scale(1.02)';
      });
    }
    function resumeSpin(){
      uiCubes.forEach(el=>{
        el.removeAttribute('data-active');
        el.style.animationPlayState = '';
        el.style.transform = ''; // back to animated state
      });
    }

    function loop(t){
      const dt = t - lastT; lastT = t; remain -= dt;
      cycleEl.textContent = fmt(remain);
      subEl.innerHTML = (mode==='spin')
        ? `Next stop in <span class="font-bold">${fmt(remain)}</span>`
        : `Paused • revealing <span class="font-bold">${fmt(remain)}</span>`;

      if(remain<=0){
        if(mode==='spin'){
          window.__freezeCubes = true;
          lockRandomLettersAndColor();
          mode='pause'; remain=PAUSE_MS;
        }else{
          window.__freezeCubes = false;
          resumeSpin();
          mode='spin'; remain=CYCLE_MS;
        }
      }
      requestAnimationFrame(loop);
    }
    requestAnimationFrame(loop);
  </script>

  <!-- Three.js logic (unchanged) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script>
    let scene, camera, renderer, cubes = [], selectedLetters = [], currentCubeIndex = 0;
    let mouse = new THREE.Vector2();
    let raycaster = new THREE.Raycaster();
    let selectedColorIndex = 7;

    const colorPalette = [
      0xff6b6b, 0x4ecdc4, 0x45b7d1, 0xffa726, 0xab47bc, 0x66bb6a,
      0xef5350, 0x42a5f5, 0xff7043, 0xec407a, 0x26c6da, 0xd4e157
    ];

    const BET_HISTORY_KEY = "bk.betHistory.v2";
    const hexFromInt = (int) => "#" + int.toString(16).padStart(6,'0');
    const fmtDT = (ts) => new Date(ts).toLocaleString([], {month:'short',day:'2-digit',hour:'2-digit',minute:'2-digit'});
    function loadHistory(){ try{ return JSON.parse(localStorage.getItem(BET_HISTORY_KEY))||[] }catch(e){ return [] } }
    function saveHistory(list){ localStorage.setItem(BET_HISTORY_KEY, JSON.stringify(list)); }
    function renderHistory(list = loadHistory()){
      const ul = document.getElementById("betHistory"); if(!ul) return;
      ul.innerHTML = list.map(e=>{
        const spacedLetters = e.letters.split('').join(' ');
        return `<li class="history-item"><span class="swatch" style="background:${e.color}"></span>
          <div class="history-meta"><div class="history-letters">${spacedLetters}</div>
          <div class="history-sub">${e.color.toUpperCase()} • ${fmtDT(e.ts)}</div></div></li>`;
      }).join("");
    }
    function addCurrentBetToHistory(){
      const letters = selectedLetters.join('');
      const color = hexFromInt(colorPalette[selectedColorIndex]);
      const list = loadHistory(); list.unshift({letters,color,ts:Date.now()}); if(list.length>30) list.pop(); saveHistory(list); renderHistory(list);
    }

    function init() {
      scene = new THREE.Scene();
      scene.fog = new THREE.Fog(0x667eea, 10, 100);

      const container = document.getElementById('canvas-container');
      const aspect = container.clientWidth / container.clientHeight;
      camera = new THREE.PerspectiveCamera(75, aspect, 0.1, 1000);

      const isMobile = window.innerWidth <= 768;
      camera.position.set(0, 0, isMobile ? 12 : 9.5);

      renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setSize(container.clientWidth, container.clientHeight);
      renderer.setClearColor(0x000000, 0);
      renderer.shadowMap.enabled = true;
      renderer.shadowMap.type = THREE.PCFSoftShadowMap;
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
      container.appendChild(renderer.domElement);

      const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
      scene.add(ambientLight);

      const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
      directionalLight.position.set(10, 10, 5);
      directionalLight.castShadow = true;
      directionalLight.shadow.mapSize.width = isMobile ? 1024 : 2048;
      directionalLight.shadow.mapSize.height = isMobile ? 1024 : 2048;
      scene.add(directionalLight);

      const selectedColor = colorPalette[selectedColorIndex];
      for (let i = 0; i < 4; i++) {
        const light = new THREE.PointLight(selectedColor, 0.5, 20);
        light.position.set((i - 1.5) * 4, Math.sin(i * Math.PI / 2) * 2, 3);
        scene.add(light);
      }

      createCubes();

      window.addEventListener('resize', onWindowResize);
      renderer.domElement.addEventListener('mousemove', onMouseMove);
      renderer.domElement.addEventListener('touchstart', onTouchStart, { passive: true });
      renderer.domElement.addEventListener('touchmove', onTouchMove, { passive: true });

      renderHistory();
      animate();
    }

    function createCubes() {
      const isMobile = window.innerWidth <= 768;
      const cubeSize = isMobile ? 5.8 : 2.4;
      const spacing  = isMobile ? 5.6 : 3.2;

      for (let i = 0; i < 4; i++) {
        const selectedColor = colorPalette[selectedColorIndex];

        const geometry = new THREE.BoxGeometry(cubeSize, cubeSize, cubeSize);
        const material = new THREE.MeshPhongMaterial({
          color: selectedColor, shininess: 100, specular: 0x222222, transparent: true, opacity: 0.9
        });

        const cube = new THREE.Mesh(geometry, material);
        cube.position.x = (i - 1.5) * spacing;
        cube.position.y = 0;
        cube.castShadow = true;
        cube.receiveShadow = true;

        const canvas = document.createElement('canvas');
        const canvasSize = isMobile ? 176 : 288;
        canvas.width = canvas.height = canvasSize;
        const context = canvas.getContext('2d');

        context.fillStyle = 'rgba(255, 255, 255, 0.9)';
        context.fillRect(0, 0, canvasSize, canvasSize);
        context.fillStyle = '#333';
        context.font = `bold ${Math.floor(canvasSize * 0.7)}px Arial`;
        context.textAlign = 'center';
        context.textBaseline = 'middle';
        context.fillText('?', canvasSize / 2, canvasSize / 2);

        const texture = new THREE.CanvasTexture(canvas);
        const textMaterial = new THREE.MeshBasicMaterial({ map: texture, transparent: true });

        const textSize = cubeSize * 0.8;
        const textGeometry = new THREE.PlaneGeometry(textSize, textSize);
        const textMesh = new THREE.Mesh(textGeometry, textMaterial);
        textMesh.position.z = cubeSize / 2 + 0.01;
        cube.add(textMesh);

        cube.userData = { textMesh, canvas, context, originalColor: selectedColor, isEmpty: true, canvasSize };
        scene.add(cube);
        cubes.push(cube);
      }
    }

    function updateCubeText(cubeIndex, letter) {
      const cube = cubes[cubeIndex];
      const { context, textMesh, canvasSize } = cube.userData;

      context.fillStyle = 'rgba(255, 255, 255, 0.95)';
      context.fillRect(0, 0, canvasSize, canvasSize);
      context.fillStyle = '#2c3e50';
      context.font = `bold ${Math.floor(canvasSize * 0.7)}px Arial`;
      context.textAlign = 'center';
      context.textBaseline = 'middle';
      context.fillText(letter, canvasSize / 2, canvasSize / 2);

      textMesh.material.map.needsUpdate = true;
      cube.userData.isEmpty = letter === '?';
    }

    function disableLetterBtn(letter){
      document.querySelectorAll('#tjs .letter-btn').forEach(btn=>{
        if(btn.textContent.trim() === letter){ btn.disabled = true; }
      });
    }

    function animateCubeSelection(cubeIndex) {
      const cube = cubes[cubeIndex];
      const selectedColor = colorPalette[selectedColorIndex];

      const startRotation = cube.rotation.clone();
      const startScale = cube.scale.clone();
      const startTime = Date.now();

      function animateOnce() {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / 1000, 1);
        const easeProgress = 1 - Math.pow(1 - progress, 3);

        cube.rotation.x = startRotation.x + Math.sin(easeProgress * Math.PI * 4) * 0.5;
        cube.rotation.y = startRotation.y + easeProgress * Math.PI * 2;
        cube.rotation.z = startRotation.z + Math.cos(easeProgress * Math.PI * 3) * 0.3;

        const scaleMultiplier = 1 + Math.sin(easeProgress * Math.PI * 2) * 0.2;
        cube.scale.copy(startScale).multiplyScalar(scaleMultiplier);

        const colorIntensity = 1 + Math.sin(easeProgress * Math.PI * 6) * 0.5;
        cube.material.emissive.setHex(selectedColor);
        cube.material.emissive.multiplyScalar(colorIntensity * 0.3);

        if (progress < 1) requestAnimationFrame(animateOnce);
        else { cube.scale.copy(startScale); cube.material.emissive.setHex(0x000000); }
      }
      animateOnce();
    }

    function selectColor(colorIndex, colorHex) {
      selectedColorIndex = colorIndex;
      document.querySelectorAll('#tjs .color-btn').forEach(btn => btn.classList.remove('selected'));
      document.querySelectorAll('#tjs .color-btn')[colorIndex].classList.add('selected');

      cubes.forEach(cube => {
        cube.material.color.setHex(colorHex);
        cube.userData.originalColor = colorHex;

        const startTime = Date.now();
        function animateColorChange() {
          const elapsed = Date.now() - startTime;
          const progress = Math.min(elapsed / 500, 1);
          const pulseIntensity = Math.sin(progress * Math.PI * 4) * 0.2;
          cube.material.emissive.setHex(colorHex);
          cube.material.emissive.multiplyScalar(pulseIntensity);
          if (progress < 1) requestAnimationFrame(animateColorChange);
          else cube.material.emissive.setHex(0x000000);
        }
        animateColorChange();
      });
    }

    function selectLetter(letter) {
      if (selectedLetters.length >= 4) return;
      if (selectedLetters.includes(letter)) { flashStatus(`${letter} already picked`); shakeInfo(); return; }

      selectedLetters.push(letter);
      disableLetterBtn(letter);
      updateCubeText(currentCubeIndex, letter);
      animateCubeSelection(currentCubeIndex);
      currentCubeIndex++;

      updateStatus();
      if (selectedLetters.length >= 4) { disableButtons(); }
    }

    function clearBoxes() {
      selectedLetters = []; currentCubeIndex = 0;
      cubes.forEach((cube, index) => {
        updateCubeText(index, '?'); cube.rotation.set(0,0,0); cube.scale.set(1,1,1); cube.material.emissive.setHex(0x000000);
      });
      enableButtons();
      updateStatus();
    }

    function updateStatus() {
      const el = document.getElementById('status');
      if (el) el.textContent = `Selected: ${selectedLetters.length}/4`;
    }

    function disableButtons(){ document.querySelectorAll('#tjs .letter-btn').forEach(b=>b.disabled=true); }
    function enableButtons(){ document.querySelectorAll('#tjs .letter-btn').forEach(b=>b.disabled=false); }

    function onTouchStart(event){
      if(event.touches.length===1){
        const t=event.touches[0], r=renderer.domElement.getBoundingClientRect();
        mouse.x=((t.clientX-r.left)/r.width)*2-1; mouse.y=-((t.clientY-r.top)/r.height)*2+1;
      }
    }
    function onTouchMove(event){
      if(event.touches.length===1){
        const t=event.touches[0], r=renderer.domElement.getBoundingClientRect();
        mouse.x=((t.clientX-r.left)/r.width)*2-1; mouse.y=-((t.clientY-r.top)/r.height)*2+1;
      }
    }

    function onWindowResize() {
      const container = document.getElementById('canvas-container');
      const aspect = container.clientWidth / container.clientHeight;
      camera.aspect = aspect; camera.updateProjectionMatrix();
      const isMobile = window.innerWidth <= 768;
      camera.position.z = isMobile ? 12 : 9.5;
      renderer.setSize(container.clientWidth, container.clientHeight);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      if (cubes.length > 0) {
        const currentLetters = selectedLetters.slice(); const currentIndex = currentCubeIndex;
        cubes.forEach(c => {
          scene.remove(c); c.geometry.dispose(); c.material.dispose();
          if (c.userData.textMesh){ c.userData.textMesh.geometry.dispose(); c.userData.textMesh.material.dispose(); }
        });
        cubes.length = 0;
        createCubes();
        currentLetters.forEach((L,i)=>updateCubeText(i,L));
        selectedLetters = currentLetters; currentCubeIndex = currentIndex;
      }
    }

    function onMouseMove(event){
      const r=renderer.domElement.getBoundingClientRect();
      mouse.x=((event.clientX-r.left)/r.width)*2-1; mouse.y=-((event.clientY-r.top)/r.height)*2+1;
    }

    function animate(){
      requestAnimationFrame(animate);
      const time = Date.now()*0.001;
      cubes.forEach((cube,i)=>{
        if(cube.userData.isEmpty){
          cube.position.y = Math.sin(time + i*Math.PI/2)*0.1;
          cube.rotation.x = Math.sin(time*0.5 + i)*0.05;
          cube.rotation.z = Math.cos(time*0.3 + i)*0.05;
        }
      });
      camera.position.x = Math.sin(time*0.4)*0.5;
      camera.position.y = Math.cos(time*0.15)*0.3;
      camera.lookAt(0,0,0);
      renderer.render(scene,camera);
    }

    window.addEventListener('load', init);

    function luckyPick(){
      const idx = Math.floor(Math.random() * colorPalette.length);
      const hex = colorPalette[idx];
      selectColor(idx, hex);

      const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      clearBoxes();
      const picks = new Set();
      while (picks.size < 4) {
        const ch = alphabet[Math.floor(Math.random()*26)];
        picks.add(ch);
      }
      [...picks].forEach(ch => selectLetter(ch));
      flashStatus("Lucky picks locked in!");
    }

    function playGame(){
      if (selectedLetters.length < 4) { flashStatus("Pick 4 letters first!"); shakeInfo(); return; }
      addCurrentBetToHistory();
      fireConfetti(900);
      flashStatus("Good luck!");
      pulseCubes();
    }

    function flashStatus(msg){
      const el = document.getElementById('status'); if(!el) return;
      el.textContent = msg + " • Selected: " + selectedLetters.length + "/4";
      el.animate([{opacity:.6},{opacity:1}], {duration:300, easing:"ease-out"});
      setTimeout(()=>{ el.textContent = `Selected: ${selectedLetters.length}/4`; }, 1200);
    }
    function shakeInfo(){
      const panel = document.querySelector('#tjs .info-panel'); if(!panel) return;
      panel.animate([{ transform:"translateX(0)" },{ transform:"translateX(-6px)" },{ transform:"translateX(6px)" },{ transform:"translateX(0)" }], { duration:260, easing:"ease-in-out" });
    }
    function pulseCubes(){
      cubes.forEach(c=>{
        c.scale.set(1,1,1);
        const start = performance.now();
        function step(t){
          const k = Math.min((t-start)/380,1);
          const s = 1 + Math.sin(k*Math.PI)*0.12;
          c.scale.set(s,s,s);
          if(k<1) requestAnimationFrame(step); else c.scale.set(1,1,1);
        }
        requestAnimationFrame(step);
      });
    }

    function fireConfetti(count=600){
      const canvas = document.getElementById('confetti');
      const ctx = canvas.getContext('2d');
      const DPR = Math.min(window.devicePixelRatio || 1, 2);
      const { innerWidth: W, innerHeight: H } = window;
      canvas.width = W * DPR; canvas.height = H * DPR; canvas.style.width = W + "px"; canvas.style.height = H + "px";
      ctx.scale(DPR, DPR);

      const colors = ['#ff6b6b','#ffd93d','#6bcB77','#4d96ff','#b770ff','#ff8e3c'];
      const parts = Array.from({length: count}, () => ({
        x: Math.random()*W, y: -10 - Math.random()*H*0.3,
        w: 6 + Math.random()*6, h: 10 + Math.random()*12,
        vx: -1 + Math.random()*2, vy: 2 + Math.random()*3.5,
        rot: Math.random()*Math.PI, vr: -0.2 + Math.random()*0.4,
        col: colors[Math.floor(Math.random()*colors.length)],
        life: 120 + Math.random()*60
      }));

      let anim; const start = performance.now();
      function draw(t){
        ctx.clearRect(0,0,W,H);
        parts.forEach(p=>{
          p.x += p.vx; p.y += p.vy; p.rot += p.vr; p.vy += 0.03; p.life -= 1;
          ctx.save(); ctx.translate(p.x, p.y); ctx.rotate(p.rot);
          ctx.fillStyle = p.col; ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h); ctx.restore();
        });
        if (performance.now()-start < 2200 && parts.some(p=>p.life>0 && p.y<H+40)) {
          anim = requestAnimationFrame(draw);
        } else { ctx.clearRect(0,0,W,H); cancelAnimationFrame(anim); }
      }
      draw();
    }
  </script>
</body>
</html>
