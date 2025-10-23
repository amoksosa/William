<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Turbo Letters • Rainbow BG + Synced Random Cubes</title>

  <!-- Tailwind (CDN) -->
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
            flipIn:   { "0%": { transform: "rotateX(90deg)", opacity:.0 }, "100%": { transform: "rotateX(0)", opacity:1 } },
            twinkle:  { "0%,100%": { opacity:.15 }, "50%": { opacity:.55 } },
            bob:      { "0%": { transform:"translateY(0) rotateX(-10deg)" }, "50%": { transform:"translateY(-6px) rotateX(-10deg)" }, "100%": { transform:"translateY(0) rotateX(-10deg)" } },
            shine:    { "0%": { transform:"translateX(-140%) rotate(12deg)" }, "100%": { transform:"translateX(140%) rotate(12deg)" } },
            /* Rainbow BG engines */
            spin360:  { "0%": { transform:"rotate(0deg)" }, "100%": { transform:"rotate(360deg)" } },
            flow:     { "0%": { backgroundPosition:"0% 50%" }, "100%": { backgroundPosition:"400% 50%" } }
          },
          animation: {
            ringSpin: "ringSpin 14s linear infinite",
            flipIn:   "flipIn .35s cubic-bezier(.2,.8,.2,1)",
            twinkle:  "twinkle 3.2s ease-in-out infinite",
            bob:      "bob 3.6s ease-in-out infinite",
            shine:    "shine .3s ease-out 1",
            rainbowSpin: "spin360 4s linear infinite",
            rainbowFlow: "flow 2.2s linear infinite"
          },
          boxShadow: {
            neon: "0 0 10px rgba(255,255,255,.75), 0 0 36px rgba(255,255,255,.28)"
          }
        }
      }
    }
  </script>

  <style>
    :root{ --accent:#ffd400; }
    .neon-accent{
      color:var(--accent);
      text-shadow:0 0 8px rgba(255,212,0,.95),0 0 22px rgba(255,212,0,.55),0 0 44px rgba(255,212,0,.35);
    }
    .scene{ perspective:1200px; }
    .preserve{ transform-style:preserve-3d; }

   

    /* Prize pill depth */
    .pill3d{
      position:relative; transform-style:preserve-3d;
      box-shadow:0 10px 30px rgba(0,0,0,.4), 0 0 24px rgba(255,255,255,.35);
    }
    .pill3d::after{
      content:""; position:absolute; inset:0; border-radius:64px; transform:translateZ(-16px);
      background: radial-gradient(60% 60% at 50% 30%, rgba(255,255,255,.2), rgba(0,0,0,0) 60%); filter:blur(6px);
    }
    .flip{ animation:flipIn .35s cubic-bezier(.2,.8,.2,1); transform-origin:center bottom; }

    /* ===== 3D CUBE ===== */
    .cube{
      --front:#5eead4; --side:#2dd4bf; --top:#99f6e4; --tile:#e6fffb; --text:#111827;
      --bevel-hi: rgba(255,255,255,.24);
      --bevel-lo: rgba(0,0,0,.25);
      --wire: rgba(255,255,255,.12);
      --shadow: 0 0 22px rgba(0,0,0,.35);
      position:relative; width:7rem; height:7rem; transform-style:preserve-3d;
      transition: box-shadow .35s ease, transform .3s ease;
      animation: bob 3.6s ease-in-out infinite;
    }
    .cube::after{
      content:""; position:absolute; left:50%; top:100%; width:76%; height:30px; transform:translate(-50%,-6px) rotateX(75deg);
      background: radial-gradient(50% 100% at 50% 0%, rgba(0,0,0,.35), transparent 70%); filter: blur(6px);
    }

    .face{
      position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
      backface-visibility:hidden; border-radius:.6rem; box-shadow: var(--shadow);
      transition: background .28s ease, box-shadow .28s ease, filter .28s ease;
      outline:1px solid var(--wire);
      background-image:
        linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%),
        linear-gradient( to bottom right, var(--front), var(--side));
    }
    .face.front{  transform:translateZ(56px); }
    .face.back{   transform:rotateY(180deg) translateZ(56px); }
    .face.right{  transform:rotateY( 90deg) translateZ(56px); }
    .face.left{   transform:rotateY(-90deg) translateZ(56px); }
    .face.top{
      transform:rotateX( 90deg) translateZ(56px);
      border-radius:.6rem .6rem .45rem .45rem;
      background-image:
        linear-gradient(180deg, rgba(255,255,255,.22), rgba(255,255,255,0) 50%),
        linear-gradient(to bottom, var(--top), var(--front));
    }
    .face.bottom{
      transform:rotateX(-90deg) translateZ(56px);
      background-image:
        linear-gradient(0deg, rgba(0,0,0,.35), rgba(0,0,0,.8)),
        linear-gradient(0deg, #0b1022, #0f172a);
    }
    .face::before{
      content:""; position:absolute; inset:0; border-radius:inherit; pointer-events:none;
      box-shadow: inset 2px 2px 4px var(--bevel-hi), inset -3px -3px 6px var(--bevel-lo);
      opacity:.65;
    }

    .tile{
      position:relative; width:58%; height:58%; border-radius:.55rem;
      display:flex; align-items:center; justify-content:center;
      background: var(--tile); color:var(--text);
      box-shadow: 0 6px 14px rgba(0,0,0,.25), inset 0 0 6px rgba(255,255,255,.45);
      font-weight:900; font-size:1.9rem; line-height:1; letter-spacing:.02em;
      transition: background .28s ease, color .28s ease, transform .06s ease, box-shadow .28s ease;
      transform: translateZ(1px);
      backdrop-filter: blur(3px) saturate(140%); -webkit-backdrop-filter: blur(3px) saturate(140%);
      overflow:hidden;
      text-shadow: 0 1px 0 rgba(255,255,255,.25), 0 2px 0 rgba(255,255,255,.12);
    }
    .tile::after{
      content:""; position:absolute; top:-20%; left:-40%; width:60%; height:140%;
      background: linear-gradient( to right, rgba(255,255,255,0), rgba(255,255,255,.35), rgba(255,255,255,0) );
      filter: blur(6px); opacity:.0; transform: translateX(-140%) rotate(12deg);
    }
    .tile.sweep-on::after{ opacity:.55; animation: shine .3s ease-out 1; }

    /* Star/grid/aurora base */
    .bg-grid {
      background-image:
        linear-gradient(rgba(255,255,255,0.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
      background-size: 36px 36px, 36px 36px;
      mask-image: radial-gradient(90% 70% at 50% 30%, #000 70%, transparent 100%);
    }
    .bg-aurora {
      background:
        radial-gradient(60% 90% at 0% 10%, rgba(255,255,255,.10), transparent 60%),
        radial-gradient(60% 90% at 100% 0%, rgba(255,255,255,.10), transparent 60%),
        radial-gradient(100% 80% at 50% 100%, rgba(255,255,255,.08), transparent 60%);
      filter: blur(0.6px);
    }

    /* === RAINBOW BACKGROUND STACK === */
    .rainbow-stack { position:fixed; inset:0; pointer-events:none; z-index:0; }
    .rainbow-stack::before{
      content:""; position:absolute; inset:-20%;
      background:
        conic-gradient(
          from 0deg,
          #ff0040, #ff7a00, #ffd400, #a4ff00, #00ffd5, #00a2ff, #7a00ff, #ff00e1, #ff0040
        );
      filter: blur(26px) saturate(1.2);
      animation: rainbowSpin 4s linear infinite;
      mix-blend-mode: screen;
      opacity:.55;
      border-radius:50%;
    }
    .rainbow-stack::after{
      content:""; position:absolute; inset:-10%;
      background:
        linear-gradient(90deg,
          rgba(255,0,64,.65) 0%,
          rgba(255,122,0,.65) 14%,
          rgba(255,212,0,.65) 28%,
          rgba(164,255,0,.65) 42%,
          rgba(0,255,213,.65) 56%,
          rgba(0,162,255,.65) 70%,
          rgba(122,0,255,.65) 84%,
          rgba(255,0,225,.65) 100%
        );
      background-size: 400% 100%;
      animation: rainbowFlow 2.2s linear infinite;
      filter: blur(32px);
      mix-blend-mode: screen;
      opacity:.38;
    }

    /* Confetti canvas */
    #confetti { position: fixed; inset: 0; z-index: 30; pointer-events: none; }

    /* Digits */
    #amount .digit{
      transition: color .18s linear, text-shadow .18s linear, filter .18s linear;
      will-change: color, text-shadow, filter;
    }

    /* Hover interactivity */
    .cube[data-active="true"]{
      animation-play-state: paused;
      transform: translateY(-4px) rotateX(-8deg) scale(1.02);
      box-shadow: 0 18px 40px rgba(0,0,0,.5), 0 0 24px rgba(255,255,255,.08);
    }
  </style>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-dvh bg-[#070b16] bg-starfield text-white font-display overflow-hidden relative">

  <!-- Confetti -->
  <canvas id="confetti"></canvas>

  <!-- RAINBOW BACKGROUND STACK -->
  <div class="rainbow-stack"></div>

  <!-- Subtle white decor so rainbow shows via blend -->
  <div class="pointer-events-none fixed inset-0 -z-0">
    <div class="absolute inset-0 mix-blend-screen">
      <div class="absolute top-10 left-[12%] size-2 rounded-full bg-white/70 animate-twinkle"></div>
      <div class="absolute top-[18%] right-[18%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:.8s]"></div>
      <div class="absolute top-[34%] left-[22%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:1.6s]"></div>
      <div class="absolute top-[42%] right-[28%] size-2 rounded-full bg-white/70 animate-twinkle [animation-delay:2.2s]"></div>
      <div class="absolute bottom-[22%] left-[36%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:2.8s]"></div>
    </div>
    <div class="absolute inset-0 mix-blend-screen">
      <div class="bg-grid absolute inset-0 opacity-[.38]"></div>
    </div>
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
      <h1 class="neon-accent text-[clamp(2rem,6vw,5rem)] leading-none font-extrabold tracking-[.08em]">JACKPOT</h1>
      <h2 class="neon-accent text-[clamp(1.6rem,5vw,3.8rem)] -mt-1 font-extrabold tracking-[.32em]">PRIZE</h2>

      <div class="mt-6 md:mt-8 inline-flex items-center gap-3 rounded-[3rem] px-7 md:px-9 py-4 md:py-5
                  bg-white/8 border border-white/25 backdrop-blur-sm pill3d shadow-neon">
        <span class="neon-accent text-[clamp(1.3rem,3.6vw,2.4rem)] font-extrabold">₱</span>
        <span id="amount" class="text-[clamp(1.9rem,5.5vw,3.3rem)] font-extrabold tabular-nums tracking-wider">6,000,000</span>
        <span class="ml-2 inline-block w-3 h-3 rounded-full border border-white/60 shadow-neon"></span>
      </div>

      <p class="mt-3 text-white/70 text-sm">This might be your lucky day!</p>
    </section>

    <!-- 4 CUBES -->
    <section class="mt-12 md:mt-16 preserve">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 place-items-center">

        <div class="cube" data-cube>
          <div class="face front"><div class="tile" data-letter></div></div>
          <div class="face back"><div class="tile" data-letter></div></div>
          <div class="face right"><div class="tile" data-letter></div></div>
          <div class="face left"><div class="tile" data-letter></div></div>
          <div class="face top"><div class="tile" data-letter></div></div>
          <div class="face bottom"><div class="tile" data-letter></div></div>
        </div>

        <div class="cube" data-cube>
          <div class="face front"><div class="tile" data-letter></div></div>
          <div class="face back"><div class="tile" data-letter></div></div>
          <div class="face right"><div class="tile" data-letter></div></div>
          <div class="face left"><div class="tile" data-letter></div></div>
          <div class="face top"><div class="tile" data-letter></div></div>
          <div class="face bottom"><div class="tile" data-letter></div></div>
        </div>

        <div class="cube" data-cube>
          <div class="face front"><div class="tile" data-letter></div></div>
          <div class="face back"><div class="tile" data-letter></div></div>
          <div class="face right"><div class="tile" data-letter></div></div>
          <div class="face left"><div class="tile" data-letter></div></div>
          <div class="face top"><div class="tile" data-letter></div></div>
          <div class="face bottom"><div class="tile" data-letter></div></div>
        </div>

        <div class="cube" data-cube>
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
      <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-white/20"></div>
      <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-white/16"></div>
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
    /* ===================== HELPERS ===================== */
    const hsl = (h,s,l,a=1)=>`hsla(${h}, ${s}%, ${l}%, ${a})`;
    const rand = n => Math.floor(Math.random()*n);
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    /* ===================== JACKPOT (digits stay static color) ===================== */
    let amount = 6000000;
    const amountEl = document.getElementById("amount");
    const resetBtn = document.getElementById("resetBtn");
    const shuffleBtn = document.getElementById("shuffleOnce");
    const peso = n => n.toLocaleString("en-PH");
    const flip = el => { el.classList.remove("flip"); void el.offsetWidth; el.classList.add("flip"); };

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

    /* ===================== LETTERS ===================== */
    const letterTiles = Array.from(document.querySelectorAll("[data-letter]"));
    const LETTER_INTERVAL_MS = 35;
    function randLetter(){ return letters[rand(letters.length)]; }
    function shuffleLetters(){
      letterTiles.forEach(tile=>{
        tile.textContent = randLetter();
        tile.style.transition = "transform 60ms ease";
        tile.style.transform = "translateZ(1px) scale(.98)";
        requestAnimationFrame(()=> { tile.style.transform = "translateZ(1px) scale(1)"; });
      });
    }
    shuffleLetters();
    setInterval(shuffleLetters, LETTER_INTERVAL_MS);
    shuffleBtn.addEventListener("click", shuffleLetters);

    /* ===================== CUBES: RANDOM but SYNCHRONIZED ===================== */
    const cubes = Array.from(document.querySelectorAll("[data-cube]"));

    // Speed of color changes (smaller = mas mabilis)
    const SPEED_MS = 140;

    function paletteFromHue(h){
      // Single hue, varied lightness for cube faces/tiles
      const front = hsl(h, 86, 58);
      const side  = hsl(h, 86, 48);
      const top   = hsl(h, 86, 72);
      const tile  = hsl(h, 92, 96, 0.98);
      const text  = "#0b1220";
      return { front, side, top, tile, text };
    }

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
        face.style.backgroundImage = `linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%), ${bg}`;
      });
      cube.querySelectorAll(".tile").forEach(tile=>{
        tile.style.background = p.tile;
        tile.style.color = p.text;
      });
    }

    function recolorCubesWithHue(h){
      const p = paletteFromHue(h);
      cubes.forEach(cube => applyPalette(cube, p));
    }

    function randomHue(){
      // bias away from very dark reds if you want, but full 0..359 is fine
      return Math.floor(Math.random() * 360);
    }

    // Initial paint
    recolorCubesWithHue(randomHue());

    // Change to a NEW random hue every tick, synchronized across all cubes
    setInterval(() => {
      const H = randomHue();
      recolorCubesWithHue(H);
    }, SPEED_MS);

    /* ===================== CONFETTI (fixed palette) ===================== */
    const cvs = document.getElementById("confetti");
    const ctx = cvs.getContext("2d");
    let W = cvs.width = innerWidth;
    let Hh = cvs.height = innerHeight;
    addEventListener("resize", () => { W = cvs.width = innerWidth; Hh = cvs.height = innerHeight; });

    const COLORS = ["#00e5ff","#ff00b3","#ffe600","#ff6b6b","#7c4dff","#22d3ee","#34d399","#f59e0b","#60a5fa","#fb7185"];
    const SHAPES = ["rect","circle","triangle"];
    const pieces = [];
    const MAX_PIECES = 260;

    function addPiece(x = Math.random() * W, y = -20, opts = {}) {
      const up = !!opts.up, burst = !!opts.burst;
      const size = burst ? 6 + Math.random()*10 : 4 + Math.random()*6;

      pieces.push({
        x, y, w:size, h:size*(0.6+Math.random()*0.6),
        r: Math.random() * Math.PI,
        vr:(Math.random()*0.1+0.05) * (Math.random()<.5?-1:1),
        vy: up ? -(2.0 + Math.random()*2.4) : (1.2 + Math.random()*2.4),
        vx:(Math.random()-0.5) * (burst?3.2:1.8),
        g:(up?-1:1) * (0.015 + Math.random()*0.02),
        color: COLORS[rand(COLORS.length)],
        shape: SHAPES[rand(SHAPES.length)],
        life: burst ? 6000 : 9000,
        born: performance.now(),
        up
      });
      if (pieces.length > MAX_PIECES) pieces.shift();
    }

    setInterval(()=>{ for (let i=0;i<4;i++) addPiece(); },180);

    function confettiBurst(count = 90){
      const cx = W * (0.35 + Math.random() * 0.3);
      const cy = Hh * (0.70 + Math.random() * 0.2);
      for (let i = 0; i < count; i++){
        const angle = Math.random() * Math.PI * 2;
        const dist = Math.random() * 40;
        addPiece(cx + Math.cos(angle) * dist, cy + Math.sin(angle) * dist, { up: true, burst: true });
      }
    }

    function centerOf(el){
      const r = el.getBoundingClientRect();
      const cx = r.left + r.width/2 + window.scrollX;
      const cy = r.top + r.height/2 + window.scrollY;
      return { cx, cy, r };
    }
    function burstFromElement(el, count = 80){
      const { cx, cy, r } = centerOf(el);
      const baseY = cy + r.height * 0.25;
      for (let i = 0; i < count; i++){
        const angle = Math.random() * Math.PI * 2;
        const dist  = Math.random() * (r.width * 0.25);
        addPiece(cx + Math.cos(angle) * dist, baseY + Math.sin(angle) * (r.height*0.15), { up: true, burst: true });
      }
    }

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

    function tiltCube(e, cube){
      const rect = cube.getBoundingClientRect();
      const mx = (e.clientX - rect.left) / rect.width;
      const my = (e.clientY - rect.top)  / rect.height;
      const rx = (my - 0.5) * -14;
      const ry = (mx - 0.5) * 18;
      cube.style.transform = `translateY(-2px) rotateX(${rx - 10}deg) rotateY(${ry}deg) scale(1.02)`;
    }

    const cubesEls = document.querySelectorAll('[data-cube]');
    cubesEls.forEach(cube=>{
      cube.addEventListener('click', () => burstFromElement(cube, 120));
      cube.addEventListener('pointerenter', () => { cube.dataset.active = "true"; startTrickle(cube); });
      cube.addEventListener('pointermove', (e) => tiltCube(e, cube));
      cube.addEventListener('pointerleave', () => { stopTrickle(cube); cube.dataset.active = "false"; cube.style.transform = ""; });
      cube.addEventListener('touchstart', () => { burstFromElement(cube, 90); startTrickle(cube); setTimeout(()=> stopTrickle(cube), 800); }, {passive:true});
    });

    function drawPiece(p){
      const {x,y,w,h,r:rot} = p;
      ctx.save(); ctx.translate(x,y); ctx.rotate(rot);
      ctx.fillStyle = p.color;
      if (p.shape==="rect") ctx.fillRect(-w/2,-h/2,w,h);
      else if (p.shape==="circle"){ ctx.beginPath(); ctx.arc(0,0,w*0.45,0,Math.PI*2); ctx.fill(); }
      else { ctx.beginPath(); ctx.moveTo(0,-h*0.6); ctx.lineTo(w*0.6,h*0.6); ctx.lineTo(-w*0.6,h*0.6); ctx.closePath(); ctx.fill(); }
      ctx.globalAlpha=.18; ctx.fillStyle="#fff"; ctx.fillRect(-w/2,-h/2,w,h*0.25); ctx.restore(); ctx.globalAlpha=1;
    }

    function tick(){
      ctx.clearRect(0,0,W,Hh); const now = performance.now();
      for (let i=pieces.length-1; i>=0; i--){
        const p = pieces[i];
        p.vy += p.g; p.y += p.vy; p.x += p.vx + Math.sin((now + i*77)/900)*0.3; p.r += p.vr;
        const offUp = p.up && (p.y < -40), offDown = !p.up && (p.y > Hh + 40);
        if (offUp || offDown || (now - p.born > p.life)){ pieces.splice(i,1); continue; }
        drawPiece(p);
      }
      requestAnimationFrame(tick);
    }

    confettiBurst(140);
    tick();
  </script>
</body>
</html>
