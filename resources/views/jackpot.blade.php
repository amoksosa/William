<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Rapid Color Numbers + Colorful Cubes</title>

  <!-- Tailwind (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ["Poppins","ui-sans-serif","system-ui"] },
          backgroundImage: {
            starfield:
              "radial-gradient(1200px 600px at 50% 20%, rgba(0,255,171,.10), rgba(0,0,0,0)), radial-gradient(900px 460px at 50% 35%, rgba(0,153,255,.10), rgba(0,0,0,0))",
          },
          keyframes: {
            ringSpin: { "0%": { transform: "rotateY(0) rotateX(25deg)" }, "100%": { transform: "rotateY(360deg) rotateX(25deg)" } },
            cubeSpin: { "0%": { transform: "rotateX(-10deg) rotateY(0deg)" }, "100%": { transform: "rotateX(-10deg) rotateY(360deg)" } },
            flipIn:   { "0%": { transform: "rotateX(90deg)", opacity:.0 }, "100%": { transform: "rotateX(0)", opacity:1 } },
            twinkle:  { "0%,100%": { opacity:.15 }, "50%": { opacity:.55 } },
            sweep:    { "0%": { transform:"translateX(-30%)" }, "100%": { transform:"translateX(30%)" } }
          },
          animation: {
            ringSpin: "ringSpin 14s linear infinite",
            cubeSpin: "cubeSpin 10s linear infinite",
            flipIn:   "flipIn .35s cubic-bezier(.2,.8,.2,1)",
            twinkle:  "twinkle 3.2s ease-in-out infinite",
            sweep:    "sweep 18s ease-in-out infinite alternate"
          },
          boxShadow: {
            neonCyan: "0 0 10px rgba(0,255,255,.9), 0 0 36px rgba(0,255,255,.35)"
          }
        }
      }
    }
  </script>

  <style>
    :root{ --cyan:#67f6ff; --yellow:#ffd400; }
    .neon-cyan{
      color:var(--cyan);
      text-shadow:0 0 8px rgba(0,255,255,.9),0 0 22px rgba(0,255,255,.5),0 0 44px rgba(0,255,255,.35);
    }
    .neon-yellow{
      color:var(--yellow);
      text-shadow:0 0 8px rgba(255,212,0,.9),0 0 22px rgba(255,212,0,.5),0 0 44px rgba(255,212,0,.35);
    }

    .scene{ perspective:1200px; }
    .preserve{ transform-style:preserve-3d; }

    /* Tilted neon ring */
    .ring3d{
      position:relative; border:3px solid rgba(0,255,171,.35); border-radius:999px;
      box-shadow:0 0 18px rgba(0,255,171,.6), inset 0 0 18px rgba(0,255,171,.35);
      background:
        radial-gradient(120% 200% at 50% 60%, rgba(0,255,171,.2), rgba(0,255,171,0) 60%),
        radial-gradient(120% 200% at 50% 40%, rgba(0,255,255,.15), rgba(0,255,255,0) 60%);
    }

    /* Prize pill depth */
    .pill3d{
      position:relative; transform-style:preserve-3d;
      box-shadow:0 10px 30px rgba(0,0,0,.4), 0 0 24px rgba(0,255,255,.45);
    }
    .pill3d::after{
      content:""; position:absolute; inset:0; border-radius:64px; transform:translateZ(-16px);
      background: radial-gradient(60% 60% at 50% 30%, rgba(0,255,255,.14), rgba(0,0,0,0) 60%); filter:blur(6px);
    }
    .flip{ animation:flipIn .35s cubic-bezier(.2,.8,.2,1); transform-origin:center bottom; }

    /* ===== 3D CUBE with CSS variables (recolored by JS) ===== */
    .cube{
      --front:#5eead4;
      --side:#2dd4bf;
      --top:#99f6e4;
      --tile:#e6fffb;
      --text:#111827;
      --shadow: 0 0 22px rgba(0,0,0,.35);

      position:relative; width:7rem; height:7rem; transform-style:preserve-3d;
      transition: box-shadow .35s ease;
    }
    .face{ position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
      backface-visibility:hidden; border-radius:.5rem; box-shadow: var(--shadow); transition: background .28s ease;
    }
    .face.front{  transform:translateZ(56px); background:linear-gradient(135deg, var(--front), var(--side)); }
    .face.back{   transform:rotateY(180deg) translateZ(56px); background:var(--side); }
    .face.right{  transform:rotateY( 90deg) translateZ(56px); background:var(--side); }
    .face.left{   transform:rotateY(-90deg) translateZ(56px); background:var(--side); }
    .face.top{    transform:rotateX( 90deg) translateZ(56px); background:var(--top); border-radius:.5rem .5rem .35rem .35rem; }
    .face.bottom{ transform:rotateX(-90deg) translateZ(56px); background:#0f172a; }

    /* Small tile + letter inside each face */
    .tile{
      width:58%; height:58%; border-radius:.55rem;
      display:flex; align-items:center; justify-content:center;
      background: var(--tile); color:var(--text);
      box-shadow: 0 6px 14px rgba(0,0,0,.25), inset 0 0 6px rgba(255,255,255,.45);
      font-weight:800; font-size:1.8rem; line-height:1;
      text-shadow:0 1px 0 rgba(255,255,255,.25);
      transition: background .28s ease, color .28s ease;
    }

    /* Background deco */
    .bg-grid {
      background-image:
        linear-gradient(rgba(0, 255, 171, 0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 255, 171, 0.05) 1px, transparent 1px);
      background-size: 36px 36px, 36px 36px;
      mask-image: radial-gradient(90% 70% at 50% 30%, #000 70%, transparent 100%);
    }
    .bg-aurora {
      background:
        radial-gradient(60% 90% at 0% 10%, rgba(0,255,171,.10), transparent 60%),
        radial-gradient(60% 90% at 100% 0%, rgba(0,153,255,.10), transparent 60%),
        radial-gradient(100% 80% at 50% 100%, rgba(0,255,255,.08), transparent 60%);
      filter: blur(0.5px);
    }
    .bg-aurora::before{
      content:""; position:absolute; inset:-10% -30%; pointer-events:none;
      background: linear-gradient(90deg, rgba(0,255,171,.08), rgba(0,153,255,.06), rgba(255,221,0,.06));
      mix-blend-mode: screen; transform: skewY(-8deg);
      animation: sweep 18s ease-in-out infinite alternate;
    }
    .bokeh-dot { width:18px; height:18px; border-radius:999px; filter: blur(2px);
      background: radial-gradient(circle at 35% 35%, rgba(255,255,255,.9), rgba(255,255,255,0) 60%); opacity:.35; }
    .bokeh-dot.is-cyan { background: radial-gradient(circle at 35% 35%, rgba(64,255,245,.9), rgba(64,255,245,0) 60%); }
    .bokeh-dot.is-yellow { background: radial-gradient(circle at 35% 35%, rgba(255,227,96,.9), rgba(255,227,96,0) 60%); }

    /* Confetti canvas */
    #confetti { position: fixed; inset: 0; z-index: 30; pointer-events: none; }

    /* Per-digit transitions */
    #amount .digit{
      transition: color .18s linear, text-shadow .18s linear, filter .18s linear;
      will-change: color, text-shadow, filter;
    }
  </style>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-dvh bg-[#070b16] bg-starfield text-white font-display overflow-hidden relative">

  <!-- Confetti layer -->
  <canvas id="confetti"></canvas>

  <!-- Decorative background layers -->
  <div class="pointer-events-none fixed inset-0 -z-0">
    <div class="absolute inset-0 mix-blend-screen">
      <div class="absolute top-10 left-[12%] size-2 rounded-full bg-white/70 animate-twinkle"></div>
      <div class="absolute top-[18%] right-[18%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:.8s]"></div>
      <div class="absolute top-[34%] left-[22%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:1.6s]"></div>
      <div class="absolute top-[42%] right-[28%] size-2 rounded-full bg-white/70 animate-twinkle [animation-delay:2.2s]"></div>
      <div class="absolute bottom-[22%] left-[36%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:2.8s]"></div>
    </div>
    <div class="absolute inset-0 mix-blend-screen">
      <div class="bokeh-dot is-cyan absolute top-[24%] left-[8%]"></div>
      <div class="bokeh-dot is-yellow absolute top-[12%] right-[12%] scale-125"></div>
      <div class="bokeh-dot is-cyan absolute bottom-[18%] left-[28%] scale-150"></div>
      <div class="bokeh-dot is-yellow absolute bottom-[26%] right-[22%]"></div>
    </div>
    <div class="absolute inset-0 bg-grid opacity-[.35]"></div>
    <div class="absolute inset-0 bg-aurora"></div>
  </div>

  <main class="relative z-10 max-w-6xl mx-auto px-5 md:px-10 pt-14 md:pt-20 pb-12 scene">
    <!-- Ring -->
    <div class="relative h-44 md:h-56 preserve">
      <div class="ring3d absolute left-1/2 -translate-x-1/2 top-2 w-[88%] md:w-[78%] aspect-[2.4/1] animate-ringSpin"
           style="transform: rotateX(25deg) translateZ(0)"></div>
    </div>

    <!-- Title + Prize -->
    <section class="text-center preserve">
      <h1 class="neon-yellow text-[clamp(2rem,6vw,5rem)] leading-none font-extrabold tracking-[.08em]">JACKPOT</h1>
      <h2 class="neon-yellow text-[clamp(1.6rem,5vw,3.8rem)] -mt-1 font-extrabold tracking-[.32em]">PRIZE</h2>

      <div class="mt-6 md:mt-8 inline-flex items-center gap-3 rounded-[3rem] px-7 md:px-9 py-4 md:py-5
                  bg-cyan-500/10 border border-cyan-300/40 backdrop-blur-sm pill3d shadow-neonCyan">
        <span class="neon-cyan text-[clamp(1.3rem,3.6vw,2.4rem)] font-extrabold">₱</span>
        <span id="amount" class="text-[clamp(1.9rem,5.5vw,3.3rem)] font-extrabold tabular-nums tracking-wider">6,000,000</span>
        <span class="ml-2 inline-block w-3 h-3 rounded-full border border-cyan-300/60 shadow-neonCyan"></span>
      </div>

      <p class="mt-3 text-white/60 text-sm">This might be your lucky day!</p>
    </section>

    <!-- 4 CUBES -->
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

    <!-- Floor glow -->
    <div class="mt-14 h-28 relative">
      <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-emerald-400/25"></div>
      <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-cyan-400/25"></div>
    </div>
  </main>

  <!-- Controls -->
  <div class="fixed bottom-4 right-4 z-20 flex gap-2">
    <button id="resetBtn" class="text-xs px-3 py-1.5 rounded-md bg-white/10 hover:bg-white/15 border border-white/15">
      Reset ₱6,000,000
    </button>
    <button id="shuffleOnce" class="text-xs px-3 py-1.5 rounded-md bg-white/10 hover:bg-white/15 border border-white/15">
      Shuffle Now
    </button>
  </div>

  <!-- Logic -->
  <script>
    /* ===================== JACKPOT ===================== */
    let amount = 6000000;
    const amountEl = document.getElementById("amount");
    const resetBtn = document.getElementById("resetBtn");
    const shuffleBtn = document.getElementById("shuffleOnce");
    const peso = n => n.toLocaleString("en-PH");
    const flip = el => { el.classList.remove("flip"); void el.offsetWidth; el.classList.add("flip"); };

    // Wrap text into per-digit spans (keep commas)
    function wrapDigits(str){
      return str.split("").map(ch => `<span class="digit">${ch}</span>`).join("");
    }

    function updatePrize(){
      amountEl.innerHTML = wrapDigits(peso(amount));
      flip(amountEl);
    }
    function tickPrize(){ amount += Math.floor(Math.random()*2000)+1; updatePrize(); confettiBurst(); }
    updatePrize();
    setInterval(tickPrize, 5000);
    resetBtn.addEventListener("click", ()=>{ amount = 6000000; updatePrize(); confettiBurst(180); });

    /* ===================== CUBES (letters + base palettes) ===================== */
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const cubes = Array.from(document.querySelectorAll("[data-cube]"));
    const letterTiles = Array.from(document.querySelectorAll("[data-letter]"));

    // Bright palettes (front/side/top/tile/text)
    const palettes = [
      {front:"#22d3ee", side:"#06b6d4", top:"#a5f3fc", tile:"#e6fdff", text:"#071a1d"},
      {front:"#34d399", side:"#10b981", top:"#bbf7d0", tile:"#eafff3", text:"#062016"},
      {front:"#60a5fa", side:"#3b82f6", top:"#93c5fd", tile:"#e8f1ff", text:"#0b1220"},
      {front:"#f472b6", side:"#e879f9", top:"#f5d0fe", tile:"#fff0fb", text:"#280a22"},
      {front:"#f59e0b", side:"#ef4444", top:"#fde68a", tile:"#fff7e5", text:"#1a1305"},
      {front:"#a78bfa", side:"#6366f1", top:"#ddd6fe", tile:"#f1efff", text:"#0f1022"},
      {front:"#fb7185", side:"#f43f5e", top:"#fecdd3", tile:"#fff1f3", text:"#22060a"},
      {front:"#84cc16", side:"#22c55e", top:"#d9f99d", tile:"#f3ffe6", text:"#0d1b09"},
      {front:"#06b6d4", side:"#0ea5e9", top:"#bae6fd", tile:"#e8f7ff", text:"#07141c"},
      {front:"#f97316", side:"#fb7185", top:"#fed7aa", tile:"#fff1e6", text:"#2a0f06"}
    ];

    const rand = n => Math.floor(Math.random()*n);
    const randLetter = () => letters[rand(letters.length)];

    function applyPalette(cube, p){
      cube.style.setProperty("--front", p.front);
      cube.style.setProperty("--side",  p.side);
      cube.style.setProperty("--top",   p.top);
      cube.style.setProperty("--tile",  p.tile);
      cube.style.setProperty("--text",  p.text);
      cube.querySelectorAll(".face").forEach(face=>{
        const isTop = face.classList.contains("top");
        const isBottom = face.classList.contains("bottom");
        let bg = `linear-gradient(135deg, ${p.front}, ${p.side})`;
        if (isTop) bg = `linear-gradient(180deg, ${p.top}, ${p.front})`;
        if (isBottom) bg = `linear-gradient(0deg, #0b1022, #0f172a)`;
        face.style.background = bg;
      });
      cube.querySelectorAll(".tile").forEach(tile=>{
        tile.style.background = p.tile;
        tile.style.color = p.text;
      });
    }

    function shuffleLetters(){
      letterTiles.forEach(tile=>{
        tile.textContent = randLetter();
        tile.animate([{transform:"scale(.8)",opacity:.0},{transform:"scale(1)",opacity:1}],{duration:200,easing:"cubic-bezier(.2,.8,.2,1)"});
      });
    }

    // initial states
    cubes.forEach(c=>applyPalette(c, palettes[rand(palettes.length)]));
    shuffleLetters();
    setInterval(shuffleLetters, 3000);
    shuffleBtn.addEventListener("click", ()=>{ shuffleLetters(); });

    /* ===================== ULTRA-FAST COLOR CYCLERS (0.5s) ===================== */
    const neonSets = [
      {c:"#22d3ee", glow:"0 0 8px rgba(34,211,238,.9),0 0 22px rgba(34,211,238,.55),0 0 44px rgba(34,211,238,.35)"},
      {c:"#60a5fa", glow:"0 0 8px rgba(96,165,250,.9),0 0 22px rgba(96,165,250,.55),0 0 44px rgba(96,165,250,.35)"},
      {c:"#34d399", glow:"0 0 8px rgba(52,211,153,.9),0 0 22px rgba(52,211,153,.55),0 0 44px rgba(52,211,153,.35)"},
      {c:"#f59e0b", glow:"0 0 8px rgba(245,158,11,.9),0 0 22px rgba(245,158,11,.55),0 0 44px rgba(245,158,11,.35)"},
      {c:"#fb7185", glow:"0 0 8px rgba(251,113,133,.9),0 0 22px rgba(251,113,133,.55),0 0 44px rgba(251,113,133,.35)"},
      {c:"#a78bfa", glow:"0 0 8px rgba(167,139,250,.9),0 0 22px rgba(167,139,250,.55),0 0 44px rgba(167,139,250,.35)"},
      {c:"#84cc16", glow:"0 0 8px rgba(132,204,22,.9),0 0 22px rgba(132,204,22,.55),0 0 44px rgba(132,204,22,.35)"},
      {c:"#06b6d4", glow:"0 0 8px rgba(6,182,212,.9),0 0 22px rgba(6,182,212,.55),0 0 44px rgba(6,182,212,.35)"}
    ];

    function recolorDigits(){
      if (!amountEl.querySelector(".digit")){
        amountEl.innerHTML = wrapDigits(amountEl.textContent);
      }
      amountEl.querySelectorAll(".digit").forEach(d=>{
        if (d.textContent === ","){
          d.style.color = "rgba(255,255,255,.75)";
          d.style.textShadow = "0 0 4px rgba(255,255,255,.25)";
          d.style.filter = "none";
          return;
        }
        const pick = neonSets[rand(neonSets.length)];
        d.style.color = pick.c;
        d.style.textShadow = pick.glow;
        d.style.filter = "drop-shadow(0 2px 6px rgba(0,0,0,.35))";
      });
    }

    function recolorCubes(){
      cubes.forEach(cube => applyPalette(cube, palettes[rand(palettes.length)]));
    }

    recolorDigits();
    recolorCubes();
    setInterval(recolorDigits, 500);
    setInterval(recolorCubes, 500);
    setInterval(()=>{ amountEl.innerHTML = wrapDigits(amountEl.textContent); }, 800);

    /* ===================== CONFETTI (canvas) ===================== */
    const cvs = document.getElementById("confetti");
    const ctx = cvs.getContext("2d");
    let W = cvs.width = innerWidth;
    let H = cvs.height = innerHeight;
    addEventListener("resize", () => { W = cvs.width = innerWidth; H = cvs.height = innerHeight; });

    const COLORS = ["#00ffab","#00e0ff","#ffd400","#ff6b6b","#7c4dff","#22d3ee","#34d399","#f59e0b","#60a5fa","#fb7185"];
    const SHAPES = ["rect","circle","triangle"];
    const pieces = [];
    const MAX_PIECES = 260;

    function addPiece(x = Math.random() * W, y = -20, opts = {}) {
      const up = !!opts.up;      // true = pataas
      const burst = !!opts.burst;
      const size = burst ? 6 + Math.random()*10 : 4 + Math.random()*6;

      pieces.push({
        x, y,
        w: size,
        h: size * (0.6 + Math.random() * 0.6),
        r: Math.random() * Math.PI,
        vr: (Math.random() * 0.1 + 0.05) * (Math.random() < .5 ? -1 : 1),
        vy: up ? -(2.0 + Math.random() * 2.4) : (1.2 + Math.random() * 2.4),
        vx: (Math.random() - 0.5) * (burst ? 3.2 : 1.8),
        g: (up ? -1 : 1) * (0.015 + Math.random() * 0.02),
        color: COLORS[rand(COLORS.length)],
        shape: SHAPES[rand(SHAPES.length)],
        life: burst ? 6000 : 9000,
        born: performance.now(),
        up
      });

      if (pieces.length > MAX_PIECES) pieces.shift();
    }

    // Ambient rain (pababa pa rin for contrast)
    setInterval(()=>{ for (let i=0;i<4;i++) addPiece(); },180);

    // Global upward burst (used by jackpot ticks/reset)
    function confettiBurst(count = 90){
      const cx = W * (0.35 + Math.random() * 0.3);
      const cy = H * (0.70 + Math.random() * 0.2); // near bottom
      for (let i = 0; i < count; i++){
        const angle = Math.random() * Math.PI * 2;
        const dist = Math.random() * 40;
        addPiece(cx + Math.cos(angle) * dist, cy + Math.sin(angle) * dist, { up: true, burst: true });
      }
    }

    // === NEW: Make EVERY cube emit upward confetti ===
    function centerOf(el){
      const r = el.getBoundingClientRect();
      const cx = r.left + r.width  / 2 + window.scrollX;
      const cy = r.top  + r.height / 2 + window.scrollY;
      return { cx, cy, r };
    }

    function burstFromElement(el, count = 80){
      const { cx, cy, r } = centerOf(el);
      // spawn around the bottom edge of the cube for nicer "from box" feel
      const baseY = cy + r.height * 0.25;
      for (let i = 0; i < count; i++){
        const angle = Math.random() * Math.PI * 2;
        const dist  = Math.random() * (r.width * 0.25);
        addPiece(cx + Math.cos(angle) * dist, baseY + Math.sin(angle) * (r.height*0.15), { up: true, burst: true });
      }
    }

    // hover/press trickle controller per cube
    const trickleTimers = new WeakMap();
    function startTrickle(el){
      if (trickleTimers.get(el)) return;
      const t = setInterval(() => {
        const { cx, cy, r } = centerOf(el);
        const jitterX = (Math.random() - 0.5) * r.width * 0.35;
        addPiece(cx + jitterX, cy + r.height * 0.35, { up: true, burst: false });
      }, 120);
      trickleTimers.set(el, t);
    }
    function stopTrickle(el){
      const t = trickleTimers.get(el);
      if (t){ clearInterval(t); trickleTimers.delete(el); }
    }

    // Wire up all cubes
    cubes.forEach(cube=>{
      // Click = big burst
      cube.addEventListener('click', () => burstFromElement(cube, 120));
      // Hover start/stop
      cube.addEventListener('pointerenter', () => startTrickle(cube));
      cube.addEventListener('pointerleave', () => stopTrickle(cube));
      // Touch fallback (short burst + auto trickle timeout)
      cube.addEventListener('touchstart', (e) => {
        burstFromElement(cube, 90);
        startTrickle(cube);
        setTimeout(()=> stopTrickle(cube), 800);
      }, {passive:true});
    });

    function drawPiece(p){
      ctx.save(); ctx.translate(p.x,p.y); ctx.rotate(p.r);
      ctx.fillStyle = p.color;
      if (p.shape==="rect") ctx.fillRect(-p.w/2,-p.h/2,p.w,p.h);
      else if (p.shape==="circle"){ ctx.beginPath(); ctx.arc(0,0,p.w*0.45,0,Math.PI*2); ctx.fill(); }
      else { ctx.beginPath(); ctx.moveTo(0,-p.h*0.6); ctx.lineTo(p.w*0.6,p.h*0.6); ctx.lineTo(-p.w*0.6,p.h*0.6); ctx.closePath(); ctx.fill(); }
      ctx.globalAlpha=.18; ctx.fillStyle="#fff"; ctx.fillRect(-p.w/2,-p.h/2,p.w,p.h*0.25); ctx.restore(); ctx.globalAlpha=1;
    }

    function tick(){
      ctx.clearRect(0,0,W,H); const now = performance.now();
      for (let i=pieces.length-1; i>=0; i--){
        const p = pieces[i];
        p.vy += p.g;
        p.y  += p.vy;
        p.x  += p.vx + Math.sin((now + i*77)/900)*0.3;
        p.r  += p.vr;

        const offUp = p.up && (p.y < -40);
        const offDown = !p.up && (p.y > H + 40);
        if (offUp || offDown || (now - p.born > p.life)){ pieces.splice(i,1); continue; }

        drawPiece(p);
      }
      requestAnimationFrame(tick);
    }

    // Initial global upward burst, then animate
    confettiBurst(140);
    tick();
  </script>
</body>
</html>
