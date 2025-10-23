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
    .neon-accent{ color:var(--accent); text-shadow:0 0 8px rgba(255,212,0,.95),0 0 22px rgba(255,212,0,.55),0 0 44px rgba(255,212,0,.35); }
    .scene{ perspective:1200px; } .preserve{ transform-style:preserve-3d; }
    .lift{ transform: translateY(calc(-1 * var(--lift))); will-change: transform; }
    .jackpot-font{ font-family:"Bungee","Poppins","ui-sans-serif","system-ui"; }
    .rainbow-letter{ display:inline-block; background:linear-gradient(90deg,#ff0040,#ff7a00,#ffd400,#a4ff00,#00ffd5,#00a2ff,#7a00ff,#ff00e1,#ff0040); background-size:400% 100%; -webkit-background-clip:text; background-clip:text; color:transparent!important; animation:flow 1.1s linear infinite,hueCycle 2s linear infinite,popGlow 1.4s ease-in-out infinite; }

    /* 3D cubes (left side) */
    .cube{ --front:#5eead4; --side:#2dd4bf; --top:#99f6e4; --tile:#e6fffb; --text:#111827; --wire:rgba(255,255,255,.12);
      position:relative; width:7rem; height:7rem; transform-style:preserve-3d; transition: box-shadow .35s ease, transform .3s ease; animation: bob 3.6s ease-in-out infinite; }
    .cube::after{ content:""; position:absolute; left:50%; top:100%; width:76%; height:30px; transform:translate(-50%,-6px) rotateX(75deg);
      background:radial-gradient(50% 100% at 50% 0%, rgba(0,0,0,.35), transparent 70%); filter:blur(6px); }
    .face{ position:absolute; inset:0; display:flex; align-items:center; justify-content:center; backface-visibility:hidden; border-radius:.6rem; outline:1px solid var(--wire);
      background-image: linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%), linear-gradient(to bottom right, var(--front), var(--side)); }
    .face.front{transform:translateZ(56px);} .face.back{transform:rotateY(180deg) translateZ(56px);} .face.right{transform:rotateY(90deg) translateZ(56px);} .face.left{transform:rotateY(-90deg) translateZ(56px);}
    .face.top{ transform:rotateX(90deg) translateZ(56px); border-radius:.6rem .6rem .45rem .45rem; background-image:linear-gradient(180deg, rgba(255,255,255,.22), rgba(255,255,255,0) 50%), linear-gradient(to bottom, var(--top), var(--front)); }
    .face.bottom{ transform:rotateX(-90deg) translateZ(56px); background-image:linear-gradient(0deg, rgba(0,0,0,.35), rgba(0,0,0,.8)), linear-gradient(0deg, #0b1022, #0f172a); }
    .tile{ position:relative; width:58%; height:58%; border-radius:.55rem; display:flex; align-items:center; justify-content:center; background:var(--tile); color:var(--text);
      box-shadow:0 6px 14px rgba(0,0,0,.25), inset 0 0 6px rgba(255,255,255,.45); font-weight:900; font-size:1.9rem; letter-spacing:.02em; transform:translateZ(1px); text-shadow: 0 1px 0 rgba(255,255,255,.25), 0 2px 0 rgba(255,255,255,.12); }

    /* Background */
    .bg-grid{ background-image:linear-gradient(rgba(255,255,255,0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px); background-size:36px 36px, 36px 36px; mask-image:radial-gradient(90% 70% at 50% 30%, #000 70%, transparent 100%); }
    .bg-aurora{ background:radial-gradient(60% 90% at 0% 10%, rgba(255,255,255,.10), transparent 60%), radial-gradient(60% 90% at 100% 0%, rgba(255,255,255,.10), transparent 60%), radial-gradient(100% 80% at 50% 100%, rgba(255,255,255,.08), transparent 60%); filter:blur(.6px); }
    .rainbow-stack { position:fixed; inset:0; pointer-events:none; z-index:0; }
    .rainbow-stack::before{ content:""; position:absolute; inset:-20%; background:conic-gradient(from 0deg,#ff0040,#ff7a00,#ffd400,#a4ff00,#00ffd5,#00a2ff,#7a00ff,#ff00e1,#ff0040); filter:blur(26px) saturate(1.2); animation:rainbowSpin 4s linear infinite; mix-blend-mode:screen; opacity:.55; border-radius:50%; }
    .rainbow-stack::after{ content:""; position:absolute; inset:-10%; background:linear-gradient(90deg,rgba(255,0,64,.65) 0%,rgba(255,122,0,.65) 14%,rgba(255,212,0,.65) 28%,rgba(164,255,0,.65) 42%,rgba(0,255,213,.65) 56%,rgba(0,162,255,.65) 70%,rgba(122,0,255,.65) 84%,rgba(255,0,225,.65) 100%); background-size:400% 100%; animation:rainbowFlow 2.2s linear infinite; filter:blur(32px); mix-blend-mode:screen; opacity:.38; }

    #confetti { position: fixed; inset: 0; z-index: 30; pointer-events: none; }
    #amount .digit{ transition: color .18s linear, text-shadow .18s linear, filter .18s linear; }
    .cube[data-active="true"]{ animation-play-state: paused; transform: translateY(-4px) rotateX(-8deg) scale(1.02); box-shadow: 0 18px 40px rgba(0,0,0,.5), 0 0 24px rgba(255,255,255,.08); }

    /* RIGHT PANEL (wider + translucent) */
    .game-board-outer{ margin-top:0; display:flex; justify-content:center; align-self:start; }
    .game-board-container{
      width:100%; max-width:520px;
      background:rgba(255,255,255,.78); /* translucent */
      border:1px solid rgba(255,255,255,.45);
      border-radius:1rem; padding:1.1rem;
      backdrop-filter: blur(6px);
      box-shadow:0 12px 34px rgba(0,0,0,.45), 0 0 24px rgba(255,255,255,.08);
      margin-left:2rem; transform-origin: top center;
    }

    /* Bigger tiles */
    .game-letter-box{ width:68px; height:68px; display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:800; color:#fff; border-radius:.6rem; box-shadow:0 6px 10px rgba(0,0,0,.4); }
    .game-letter-row{ display:grid; grid-template-columns: repeat(4, 1fr); gap:.9rem; justify-items:center; align-items:center; }

    /* Color swatches: 6 per row, aligned */
    .color-swatch{ width:44px; height:44px; border-radius:.55rem; cursor:pointer; box-shadow:0 2px 6px rgba(0,0,0,.25); transition:transform .1s ease; }
    .color-swatch:hover{ transform:scale(1.05); box-shadow:0 4px 8px rgba(0,0,0,.35); }

    /* Bigger letter buttons */
    .letter-btn{ width:44px; height:44px; font-weight:700; color:#333; background:#D8CCF6; transition:background-color .15s ease, transform .05s ease; box-shadow:0 3px 6px rgba(0,0,0,.2); font-size:1rem; border-radius:.6rem; }
    .letter-btn:active{ transform:translateY(1px); }
    .letter-btn.selected{ background:#7957D5; color:#fff; }
    .letter-btn:disabled{ opacity:.45; cursor:not-allowed; filter:saturate(.6); }

    .main-grid{ display:grid; grid-template-columns:1fr 540px; gap:1.6rem; align-items:start; }
    .main-grid>*{ margin:0!important; text-align:left; }
    .main-grid .original-jackpot-content{ display:flex; flex-direction:column; align-items:center; text-align:center; }
    .main-grid .original-jackpot-content section{ text-align:center; width:100%; }

    /* History */
    .history-item{ display:flex; align-items:center; gap:.6rem; padding:.5rem .6rem; background:#f6f6fb; border:1px solid #e7e7f5; border-radius:.6rem; }
    .history-letters{ display:grid; grid-template-columns:repeat(4,56px); gap:.45rem; }
    .history-box{ width:56px; height:56px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; border-radius:.5rem; border-right:4px solid transparent; border-bottom:8px solid transparent; }
    .color-dot{ width:14px; height:14px; border-radius:999px; box-shadow:0 0 0 2px rgba(0,0,0,.06) inset; }
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

      <section class="mt-12 md:mt-16 preserve">
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

      <div class="mt-14 h-28 relative">
        <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-white/20"></div>
        <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-white/16"></div>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="game-board-outer">
      <div id="gameBoard" class="game-board-container">
        <div class="game-letter-row mb-5">
          <div id="gameCube1" class="game-letter-box bg-[#F2849F] border-b-8 border-r-4 border-[#E06485]">J</div>
          <div id="gameCube2" class="game-letter-box bg-[#F2849F] border-b-8 border-r-4 border-[#E06485]">H</div>
          <div id="gameCube3" class="game-letter-box bg-[#D64F6D] border-b-8 border-r-4 border-[#B83E58]">S</div>
          <div id="gameCube4" class="game-letter-box bg-[#D64F6D] border-b-8 border-r-4 border-[#B83E58]">D</div>
        </div>

        <p class="text-center text-gray-800 font-semibold mb-3">Choose Color</p>
        <!-- 6 columns, 2 rows, perfectly aligned -->
        <div class="grid grid-cols-6 gap-3 mb-5" id="colorPicker">
          <div class="color-swatch bg-[#F2849F]" data-color-base="#F2849F" data-color-dark="#E06485"></div>
          <div class="color-swatch bg-[#71ECBB]" data-color-base="#71ECBB" data-color-dark="#4CDAB0"></div>
          <div class="color-swatch bg-[#52B9F2]" data-color-base="#52B9F2" data-color-dark="#30A8E0"></div>
          <div class="color-swatch bg-[#FFAD40]" data-color-base="#FFAD40" data-color-dark="#E09230"></div>
          <div class="color-swatch bg-[#B052F2]" data-color-base="#B052F2" data-color-dark="#9A30E0"></div>
          <div class="color-swatch bg-[#8CC63F]" data-color-base="#8CC63F" data-color-dark="#75AF30"></div>
          <div class="color-swatch bg-[#E05B5B]" data-color-base="#E05B5B" data-color-dark="#C94747"></div>
          <div class="color-swatch bg-[#4A90E2]" data-color-base="#4A90E2" data-color-dark="#3A7AC7"></div>
          <div class="color-swatch bg-[#F5774F]" data-color-base="#F5774F" data-color-dark="#E0623A"></div>
          <div class="color-swatch bg-[#E95B8B]" data-color-base="#E95B8B" data-color-dark="#D24776"></div>
          <div class="color-swatch bg-[#55E0D2]" data-color-base="#55E0D2" data-color-dark="#40C7B9"></div>
          <div class="color-swatch bg-[#DAE04B]" data-color-base="#DAE04B" data-color-dark="#C4C937"></div>
        </div>

        <p class="text-center text-gray-800 font-semibold mb-2">Pick Letters (A–Z)</p>
        <div class="grid grid-cols-8 gap-3 mb-4" id="letterButtons">
          <button class="letter-btn" data-letter="A">A</button><button class="letter-btn" data-letter="B">B</button><button class="letter-btn" data-letter="C">C</button><button class="letter-btn" data-letter="D">D</button><button class="letter-btn" data-letter="E">E</button><button class="letter-btn" data-letter="F">F</button><button class="letter-btn" data-letter="G">G</button><button class="letter-btn" data-letter="H">H</button>
          <button class="letter-btn" data-letter="I">I</button><button class="letter-btn" data-letter="J">J</button><button class="letter-btn" data-letter="K">K</button><button class="letter-btn" data-letter="L">L</button><button class="letter-btn" data-letter="M">M</button><button class="letter-btn" data-letter="N">N</button><button class="letter-btn" data-letter="O">O</button><button class="letter-btn" data-letter="P">P</button>
          <button class="letter-btn" data-letter="Q">Q</button><button class="letter-btn" data-letter="R">R</button><button class="letter-btn" data-letter="S">S</button><button class="letter-btn" data-letter="T">T</button><button class="letter-btn" data-letter="U">U</button><button class="letter-btn" data-letter="V">V</button><button class="letter-btn" data-letter="W">W</button><button class="letter-btn" data-letter="X">X</button>
          <button class="letter-btn" data-letter="Y">Y</button><button class="letter-btn" data-letter="Z">Z</button>
        </div>

        <p class="text-center text-gray-800 font-semibold mb-2">Selected: <span id="selectedCount">4/4</span></p>
        <div class="grid grid-cols-2 gap-2 pb-2">
          <button id="playBtn" class="col-span-2 py-3 rounded-lg text-white font-bold text-lg bg-[#FF8C2B] hover:bg-[#E07A25] transition shadow-md">Play</button>
          <button id="resetBoardBtn" class="py-2.5 rounded-lg text-gray-700 font-bold bg-[#E6E6E6] hover:bg-[#D4D4D4] transition shadow-md">Reset</button>
          <button id="luckyPickBtn" class="py-2.5 rounded-lg text-white font-bold bg-[#7957D5] hover:bg-[#6847C0] transition shadow-md">Lucky Pick</button>
        </div>

        <!-- HISTORY -->
        <div class="mt-3">
          <p class="text-center text-gray-800 font-semibold mb-2">History</p>
          <div id="history" class="space-y-2"></div>
        </div>
      </div>
    </div>
  </main>

  <script>
    /* ===== Jackpot amount ===== */
    let amount = 6000000;
    const amountEl = document.getElementById("amount");
    const peso = n => n.toLocaleString("en-PH");
    const flip = el => { el.classList.remove("flip"); void el.offsetWidth; el.classList.add("flip"); };
    const wrapDigits = s => s.split("").map(ch=>`<span class="digit">${ch}</span>`).join("");
    function updatePrize(){ amountEl.innerHTML = wrapDigits(peso(amount)); flip(amountEl); }
    function tickPrize(){ amount += Math.floor(Math.random()*2000)+1; updatePrize(); confettiBurst(); }
    updatePrize(); setInterval(tickPrize, 5000);

    /* ===== Rainbow titles ===== */
    const COLOR_PALETTES=[["#ff0040","#ff7a00","#ffd400","#a4ff00","#00ffd5","#00a2ff","#7a00ff","#ff00e1"],["#ff3b3b","#ff9f1c","#ffe74c","#2aff5a","#00f5d4","#00bbff","#8a4dff","#ff4dff"],["#ff6b6b","#f7b801","#f9f871","#32ff7e","#18dcff","#7d5fff","#cd84f1","#ff4d6d"],["#ff1e56","#ffac41","#ffe156","#0be881","#1b9cfc","#3d5af1","#8e44ad","#f368e0"],["#ff2e63","#ff9a3c","#ffd166","#1be7ff","#00d1ff","#2d9bf0","#845ec2","#f65a83"]];
    const gradientFrom = c => `linear-gradient(90deg, ${c.join(",")})`;
    function rainbowize(el){ const t = el.textContent; el.textContent = ""; [...t].forEach((ch,i)=>{const s=document.createElement("span"); s.className="rainbow-letter"; s.textContent=ch; const pal=COLOR_PALETTES[Math.floor(Math.random()*COLOR_PALETTES.length)]; s.style.backgroundImage=gradientFrom(pal); s.style.backgroundSize="400% 100%"; s.style.backgroundPosition=`${(i*12)%100}% 50%`; el.appendChild(s);});}
    function cyclePalettes(el){ const spans=el.querySelectorAll(".rainbow-letter"); let idx=0; setInterval(()=>{const pal=COLOR_PALETTES[idx%COLOR_PALETTES.length]; spans.forEach((s,i)=>{s.style.backgroundImage=gradientFrom(pal); s.style.backgroundPosition=`${(i*20 + (Date.now()/40)%100)%100}% 50%`;}); idx++;},900);}
    const jackpotEl=document.getElementById("jackpot"), prizeEl=document.getElementById("prize"); rainbowize(jackpotEl); rainbowize(prizeEl); cyclePalettes(jackpotEl); cyclePalettes(prizeEl);

    /* ===== Left cubes: palettes + FAST LETTER SHUFFLE (left only) ===== */
    const cubes=[...document.querySelectorAll("[data-cube]")];
    const letterTiles=[...document.querySelectorAll(".cube .tile[data-letter]")];
    const palettes=[
      {front:"#22d3ee",side:"#06b6d4",top:"#a5f3fc",tile:"#e6fdff",text:"#071a1d"},
      {front:"#34d399",side:"#10b981",top:"#bbf7d0",tile:"#eafff3",text:"#062016"},
      {front:"#60a5fa",side:"#3b82f6",top:"#93c5fd",tile:"#e8f1ff",text:"#0b1220"},
      {front:"#f472b6",side:"#e879f9",top:"#f5d0fe",tile:"#fff0fb",text:"#280a22"},
      {front:"#f59e0b",side:"#ef4444",top:"#fde68a",tile:"#fff7e5",text:"#1a1305"},
      {front:"#a78bfa",side:"#6366f1",top:"#ddd6fe",tile:"#f1efff",text:"#0f1022"},
      {front:"#fb7185",side:"#f43f5e",top:"#fecdd3",tile:"#fff1f3",text:"#22060a"},
      {front:"#84cc16",side:"#22c55e",top:"#d9f99d",tile:"#f3ffe6",text:"#0d1b09"},
      {front:"#06b6d4",side:"#0ea5e9",top:"#bae6fd",tile:"#e8f7ff",text:"#07141c"},
      {front:"#f97316",side:"#fb7185",top:"#fed7aa",tile:"#fff1e6",text:"#2a0f06"}
    ];
    const rand=n=>Math.floor(Math.random()*n);
    function applyPalette(c,p){
      c.style.setProperty("--front",p.front); c.style.setProperty("--side",p.side); c.style.setProperty("--top",p.top);
      c.style.setProperty("--tile",p.tile); c.style.setProperty("--text",p.text);
      c.querySelectorAll(".face").forEach(f=>{
        const isTop=f.classList.contains("top"), isBottom=f.classList.contains("bottom");
        let bg=`linear-gradient(135deg, ${p.front}, ${p.side})`;
        if(isTop) bg=`linear-gradient(180deg, ${p.top}, ${p.front})`;
        if(isBottom) bg=`linear-gradient(0deg, #0b1022, #0f172a)`;
        f.style.backgroundImage=`linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%), ${bg}`;
      });
      c.querySelectorAll(".tile").forEach(t=>{ t.style.background=p.tile; t.style.color=p.text; });
    }
    cubes.forEach(c=>applyPalette(c, palettes[rand(palettes.length)]));

    const letters="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const randLetter=()=> letters[rand(letters.length)];
    const LETTER_INTERVAL_MS=40;
    function shuffleLetters(){
      letterTiles.forEach(tile=>{
        tile.textContent=randLetter();  /* cubes only, NOT A–Z buttons */
        tile.style.transition="transform 60ms ease";
        tile.style.transform="translateZ(1px) scale(.98)";
        requestAnimationFrame(()=>{ tile.style.transform="translateZ(1px) scale(1)"; });
      });
    }
    shuffleLetters();
    let letterTimer=setInterval(shuffleLetters, LETTER_INTERVAL_MS);

    /* ===== CONFETTI + interactions ===== */
    const cvs=document.getElementById("confetti"), ctx=cvs.getContext("2d"); let W=cvs.width=innerWidth, H=cvs.height=innerHeight;
    addEventListener("resize",()=>{ W=cvs.width=innerWidth; H=cvs.height=innerHeight; alignAndFitRightPanel(); });
    const COLORS=["#00e5ff","#ff00b3","#ffe600","#ff6b6b","#7c4dff","#22d3ee","#34d399","#f59e0b","#60a5fa","#fb7185"], SHAPES=["rect","circle","triangle"]; const pieces=[]; const MAX_PIECES=260;
    function addPiece(x=Math.random()*W,y=-20,opts={}){ const up=!!opts.up, burst=!!opts.burst; const size=burst?6+Math.random()*10:4+Math.random()*6;
      pieces.push({x,y,w:size,h:size*(0.6+Math.random()*0.6), r:Math.random()*Math.PI, vr:(Math.random()*0.1+0.05)*(Math.random()<.5?-1:1), vy:up?-(2.0+Math.random()*2.4):(1.2+Math.random()*2.4), vx:(Math.random()-0.5)*(burst?3.2:1.8), g:(up?-1:1)*(0.015+Math.random()*0.02), color:COLORS[rand(COLORS.length)], shape:SHAPES[rand(SHAPES.length)], life:burst?6000:9000, born:performance.now(), up});
      if(pieces.length>MAX_PIECES) pieces.shift();
    }
    setInterval(()=>{ for(let i=0;i<4;i++) addPiece(); },180);
    function confettiBurst(count=90){ const cx=W*(0.35+Math.random()*0.3), cy=H*(0.70+Math.random()*0.2); for(let i=0;i<count;i++){ const a=Math.random()*Math.PI*2, d=Math.random()*40; addPiece(cx+Math.cos(a)*d, cy+Math.sin(a)*d, {up:true, burst:true}); } }
    function centerOf(el){ const r=el.getBoundingClientRect(); return { cx:r.left + r.width/2 + window.scrollX, cy:r.top + r.height/2 + window.scrollY, r }; }
    function burstFromElement(el, count=80){ const {cx,cy,r}=centerOf(el); const baseY=cy + r.height*0.25; for(let i=0;i<count;i++){ const a=Math.random()*Math.PI*2, d=Math.random()* (r.width*0.25); addPiece(cx+Math.cos(a)*d, baseY+Math.sin(a)*(r.height*0.15), {up:true, burst:true}); } }
    const trickleTimers=new WeakMap();
    function startTrickle(el){ if(trickleTimers.get(el)) return; const t=setInterval(()=>{ const {cx,cy,r}=centerOf(el); const jitterX=(Math.random()-0.5)*r.width*0.35; addPiece(cx+jitterX, cy+r.height*0.35, {up:true, burst:false}); },120); trickleTimers.set(el,t); }
    function stopTrickle(el){ const t=trickleTimers.get(el); if(t){ clearInterval(t); trickleTimers.delete(el); } }
    function tiltCube(e,cube){ const rect=cube.getBoundingClientRect(); const mx=(e.clientX-rect.left)/rect.width; const my=(e.clientY-rect.top)/rect.height; const rx=(my-0.5)*-14; const ry=(mx-0.5)*18; cube.style.transform=`translateY(-2px) rotateX(${rx-10}deg) rotateY(${ry}deg) scale(1.02)`; }
    document.querySelectorAll('[data-cube]').forEach(cube=>{
      cube.addEventListener('click',()=> burstFromElement(cube,120));
      cube.addEventListener('pointerenter',()=>{ cube.dataset.active="true"; startTrickle(cube); });
      cube.addEventListener('pointermove',(e)=> tiltCube(e,cube));
      cube.addEventListener('pointerleave',()=>{ stopTrickle(cube); cube.dataset.active="false"; cube.style.transform=""; });
      cube.addEventListener('touchstart',()=>{ burstFromElement(cube,90); startTrickle(cube); setTimeout(()=> stopTrickle(cube),800); },{passive:true});
    });

    function drawPiece(p){ const {x,y,w,h,r}=p;
      ctx.save(); ctx.translate(x,y); ctx.rotate(r); ctx.fillStyle=p.color;
      if(p.shape==="rect") ctx.fillRect(-w/2,-h/2,w,h);
      else if(p.shape==="circle"){ ctx.beginPath(); ctx.arc(0,0,w*0.45,0,Math.PI*2); ctx.fill(); }
      else { ctx.beginPath(); ctx.moveTo(0,-h*0.6); ctx.lineTo(w*0.6,h*0.6); ctx.lineTo(-w*0.6,h*0.6); ctx.closePath(); ctx.fill(); }
      ctx.globalAlpha=.18; ctx.fillStyle="#fff"; ctx.fillRect(-w/2,-h/2,w,h*0.25); ctx.restore(); ctx.globalAlpha=1;
    }
    function tick(){ ctx.clearRect(0,0,W,H); const now=performance.now();
      for(let i=pieces.length-1;i>=0;i--){ const p=pieces[i]; p.vy+=p.g; p.y+=p.vy; p.x+=p.vx + Math.sin((now+i*77)/900)*0.3; p.r+=p.vr;
        const offUp=p.up&&(p.y<-40), offDown=!p.up&&(p.y>H+40);
        if(offUp||offDown||(now-p.born>p.life)){ pieces.splice(i,1); continue;} drawPiece(p);
      } requestAnimationFrame(tick);
    }
    confettiBurst(140); tick();

    /* ===== RIGHT board logic: no-duplicate letters + lock at 4 + history ===== */
    const gameCubes=[document.getElementById('gameCube1'),document.getElementById('gameCube2'),document.getElementById('gameCube3'),document.getElementById('gameCube4')];
    const letterBtns=document.querySelectorAll('#letterButtons button');
    const colorSwatches=document.querySelectorAll('#colorPicker div');
    const selectedCountEl=document.getElementById('selectedCount');
    const resetBoardBtn=document.getElementById('resetBoardBtn');
    const luckyPickBtn=document.getElementById('luckyPickBtn');
    const playBtn=document.getElementById('playBtn');
    const historyEl=document.getElementById('history');

    let selectedLetters=["J","H","S","D"];
    let selectedCubeIndex=0;
    let currentColor={base:"#F2849F", dark:"#E06485"};  // track chosen color set

    const isComplete = ()=> selectedLetters.filter(l=>!!l).length===4;

    function highlightCurrent(){
      gameCubes.forEach((c,i)=>{ c.style.boxShadow = i===selectedCubeIndex ? '0 0 10px 2px #7957D5' : 'none'; });
    }
    function applyColorToAll(base, dark){
      currentColor = {base, dark};
      gameCubes.forEach(c=>{
        c.style.backgroundColor=base;
        c.style.borderColor=dark;
        c.style.borderBottomColor=dark;
        c.style.borderRightColor=dark;
      });
    }
    function updateGameCubes(){
      gameCubes.forEach((c,i)=>{ c.textContent=selectedLetters[i]||""; });
      selectedCountEl.textContent=`${selectedLetters.filter(l=>l!=="").length}/4`;
      highlightCurrent();
      updateLetterButtons();
    }
    function updateLetterButtons(){
      const complete=isComplete();
      letterBtns.forEach(b=>{
        const L=b.getAttribute('data-letter');
        const used = selectedLetters.includes(L);
        b.classList.toggle('selected', used);
        b.disabled = used || complete;  // disable used letters; if 4/4, lock all
      });
    }

    // init
    applyColorToAll(currentColor.base, currentColor.dark);
    updateGameCubes();

    // choose cube
    gameCubes.forEach((c,i)=> c.addEventListener('click', ()=>{ selectedCubeIndex=i; highlightCurrent(); }));

    // choose letter (no duplicates; auto-lock at 4)
    letterBtns.forEach(btn=> btn.addEventListener('click', ()=>{
      if(isComplete()) return;
      const L=btn.getAttribute('data-letter');
      if (selectedLetters.includes(L)) return;
      selectedLetters[selectedCubeIndex]=L;
      updateGameCubes();
      selectedCubeIndex=(selectedCubeIndex+1)%4;
      highlightCurrent();
    }));

    // choose color (apply to ALL 4 boxes)
    colorSwatches.forEach(s=> s.addEventListener('click', ()=>{
      const base=s.getAttribute('data-color-base'), dark=s.getAttribute('data-color-dark');
      applyColorToAll(base, dark);
    }));

    // reset
    resetBoardBtn.addEventListener('click', ()=>{
      selectedLetters=["","","",""];
      selectedCubeIndex=0;
      applyColorToAll("#F2849F","#E06485");
      letterBtns.forEach(b=> b.disabled=false);
      updateGameCubes();
    });

    // lucky pick (unique letters + one color for all; locks after 4)
    luckyPickBtn.addEventListener('click', ()=>{
      const avail="ABCDEFGHIJKLMNOPQRSTUVWXYZ".split('');
      const pick=[];
      for(let i=0;i<4;i++){ const r=Math.floor(Math.random()*avail.length); pick.push(avail[r]); avail.splice(r,1); }
      selectedLetters=pick;
      const rs=[...colorSwatches][Math.floor(Math.random()*colorSwatches.length)];
      applyColorToAll(rs.getAttribute('data-color-base'), rs.getAttribute('data-color-dark'));
      updateGameCubes(); // will auto-lock because 4/4
    });

    // PLAY → push to history (letters + color)
    playBtn.addEventListener('click', ()=>{
      if(!isComplete()) return; // require 4 letters
      const entry=document.createElement('div');
      entry.className='history-item';

      const grid=document.createElement('div');
      grid.className='history-letters';

      selectedLetters.forEach(ch=>{
        const box=document.createElement('div');
        box.className='history-box';
        box.style.backgroundColor=currentColor.base;
        box.style.borderRightColor=currentColor.dark;
        box.style.borderBottomColor=currentColor.dark;
        box.textContent=ch;
        grid.appendChild(box);
      });

      const dot=document.createElement('div');
      dot.className='color-dot';
      dot.style.background= currentColor.base;

      const stamp=document.createElement('span');
      const s = new Date();
      const time = s.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
      stamp.className='text-[.85rem] text-gray-600';
      stamp.textContent = `• ${selectedLetters.join('')} • ${time}`;

      entry.appendChild(grid);
      entry.appendChild(dot);
      entry.appendChild(stamp);

      historyEl.prepend(entry);
      confettiBurst(90);
    });

    /* Align right panel with logo top + auto-fit */
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
      panel.style.transform = `translateY(${shiftY}px) scale(${scale})`;
      panel.style.transformOrigin = 'top center';
    }
    window.addEventListener('load', alignAndFitRightPanel);
    window.addEventListener('resize', alignAndFitRightPanel);
    setTimeout(alignAndFitRightPanel, 200);
  </script>
</body>
</html>
