<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Cubes with Letters on All Sides</title>

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
      backface-visibility:hidden; border-radius:.5rem; box-shadow: var(--shadow); transition: background .35s ease;
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
      transition: background .35s ease, color .35s ease;
    }

    /* ===== Enhanced background layers ===== */
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
    .bokeh-dot {
      width:18px; height:18px; border-radius:999px; filter: blur(2px);
      background: radial-gradient(circle at 35% 35%, rgba(255,255,255,.9), rgba(255,255,255,.0) 60%);
      opacity:.35;
    }
    .bokeh-dot.is-cyan { background: radial-gradient(circle at 35% 35%, rgba(64,255,245,.9), rgba(64,255,245,0) 60%); }
    .bokeh-dot.is-yellow { background: radial-gradient(circle at 35% 35%, rgba(255,227,96,.9), rgba(255,227,96,0) 60%); }

    /* ===== Confetti canvas ===== */
    #confetti {
      position: fixed; inset: 0; z-index: 30; pointer-events: none;
    }
  </style>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-dvh bg-[#070b16] bg-starfield text-white font-display overflow-hidden relative">

  <!-- Confetti layer -->
  <canvas id="confetti"></canvas>

  <!-- Decorative background layers -->
  <div class="pointer-events-none fixed inset-0 -z-0">
    <!-- Twinkling star clusters -->
    <div class="absolute inset-0 mix-blend-screen">
      <div class="absolute top-10 left-[12%] size-2 rounded-full bg-white/70 animate-twinkle"></div>
      <div class="absolute top-[18%] right-[18%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:.8s]"></div>
      <div class="absolute top-[34%] left-[22%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:1.6s]"></div>
      <div class="absolute top-[42%] right-[28%] size-2 rounded-full bg-white/70 animate-twinkle [animation-delay:2.2s]"></div>
      <div class="absolute bottom-[22%] left-[36%] size-1.5 rounded-full bg-white/70 animate-twinkle [animation-delay:2.8s]"></div>
    </div>

    <!-- Soft bokeh dots -->
    <div class="absolute inset-0 mix-blend-screen">
      <div class="bokeh-dot is-cyan absolute top-[24%] left-[8%]"></div>
      <div class="bokeh-dot is-yellow absolute top-[12%] right-[12%] scale-125"></div>
      <div class="bokeh-dot is-cyan absolute bottom-[18%] left-[28%] scale-150"></div>
      <div class="bokeh-dot is-yellow absolute bottom-[26%] right-[22%]"></div>
    </div>

    <!-- Faint grid, masked -->
    <div class="absolute inset-0 bg-grid opacity-[.35]"></div>

    <!-- Aurora sweep -->
    <div class="absolute inset-0 bg-aurora"></div>
  </div>

  <main class="relative z-10 max-w-6xl mx-auto px-5 md:px-10 pt-14 md:pt-20 pb-12 scene">
    <!-- 3D Neon Ring -->
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
        <span id="amount" class="neon-cyan text-[clamp(1.9rem,5.5vw,3.3rem)] font-extrabold tabular-nums tracking-wider">6,000,000</span>
        <span class="ml-2 inline-block w-3 h-3 rounded-full border border-cyan-300/60 shadow-neonCyan"></span>
      </div>

      <p class="mt-3 text-white/60 text-sm">This might be your lucky day!</p>
    </section>

    <!-- 4 CUBES -->
    <section class="mt-12 md:mt-16 preserve">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 place-items-center">

        <!-- CUBE TEMPLATE (repeat 4) -->
        <div class="cube animate-cubeSpin [animation-duration:11s]" data-cube>
          <div class="face front"  data-face><div class="tile" data-letter></div></div>
          <div class="face back"   data-face><div class="tile" data-letter></div></div>
          <div class="face right"  data-face><div class="tile" data-letter></div></div>
          <div class="face left"   data-face><div class="tile" data-letter></div></div>
          <div class="face top"    data-face><div class="tile" data-letter></div></div>
          <div class="face bottom" data-face><div class="tile" data-letter></div></div>
        </div>

        <div class="cube animate-cubeSpin [animation-delay:.2s]" data-cube>
          <div class="face front"  data-face><div class="tile" data-letter></div></div>
          <div class="face back"   data-face><div class="tile" data-letter></div></div>
          <div class="face right"  data-face><div class="tile" data-letter></div></div>
          <div class="face left"   data-face><div class="tile" data-letter></div></div>
          <div class="face top"    data-face><div class="tile" data-letter></div></div>
          <div class="face bottom" data-face><div class="tile" data-letter></div></div>
        </div>

        <div class="cube animate-cubeSpin [animation-delay:.4s] [animation-duration:12s]" data-cube>
          <div class="face front"  data-face><div class="tile" data-letter></div></div>
          <div class="face back"   data-face><div class="tile" data-letter></div></div>
          <div class="face right"  data-face><div class="tile" data-letter></div></div>
          <div class="face left"   data-face><div class="tile" data-letter></div></div>
          <div class="face top"    data-face><div class="tile" data-letter></div></div>
          <div class="face bottom" data-face><div class="tile" data-letter></div></div>
        </div>

        <div class="cube animate-cubeSpin [animation-delay:.6s] [animation-duration:9.5s]" data-cube>
          <div class="face front"  data-face><div class="tile" data-letter></div></div>
          <div class="face back"   data-face><div class="tile" data-letter></div></div>
          <div class="face right"  data-face><div class="tile" data-letter></div></div>
          <div class="face left"   data-face><div class="tile" data-letter></div></div>
          <div class="face top"    data-face><div class="tile" data-letter></div></div>
          <div class="face bottom" data-face><div class="tile" data-letter></div></div>
        </div>

      </div>
    </section>

    <!-- Floor glow -->
    <div class="mt-14 h-28 relative">
      <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-emerald-400/25"></div>
      <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-cyan-400/25"></div>
    </div>
  </main>

  <!-- Controls (optional) -->
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
    function updatePrize(){ amountEl.textContent = peso(amount); flip(amountEl); }
    function tickPrize(){ amount += Math.floor(Math.random()*2000)+1; updatePrize(); confettiBurst(); }
    updatePrize();
    setInterval(tickPrize, 5000);
    resetBtn.addEventListener("click", ()=>{ amount = 6000000; updatePrize(); confettiBurst(180); });

    /* ===================== CUBES: Random Letters on ALL faces + Colors ===================== */
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const cubes = Array.from(document.querySelectorAll("[data-cube]"));
    const letterTiles = Array.from(document.querySelectorAll("[data-letter]"));

    // Palettes (front/side/top/tile/text)
    const palettes = [
      {front:"#5eead4", side:"#2dd4bf", top:"#99f6e4", tile:"#e6fffb", text:"#111827"},
      {front:"#60a5fa", side:"#3b82f6", top:"#93c5fd", tile:"#e8f1ff", text:"#0b1220"},
      {front:"#f472b6", side:"#a855f7", top:"#e9d5ff", tile:"#fff0fb", text:"#1f0924"},
      {front:"#f59e0b", side:"#ef4444", top:"#fde68a", tile:"#fff7e5", text:"#1a1305"},
      {front:"#34d399", side:"#059669", top:"#a7f3d0", tile:"#e9fff5", text:"#082017"},
      {front:"#818cf8", side:"#6366f1", top:"#c7d2fe", tile:"#eef0ff", text:"#0e0f1d"},
      {front:"#fb7185", side:"#ef4444", top:"#fecdd3", tile:"#fff1f3", text:"#22060a"},
      {front:"#22d3ee", side:"#06b6d4", top:"#a5f3fc", tile:"#e6fdff", text:"#071a1d"}
    ];

    const rand = n => Math.floor(Math.random()*n);
    const randLetter = () => letters[rand(letters.length)];
    const applyPalette = (cube, p) => {
      cube.style.setProperty("--front", p.front);
      cube.style.setProperty("--side",  p.side);
      cube.style.setProperty("--top",   p.top);
      cube.style.setProperty("--tile",  p.tile);
      cube.style.setProperty("--text",  p.text);
    };

    function shuffleAll(){
      // random colors per cube
      cubes.forEach(cube => applyPalette(cube, palettes[rand(palettes.length)]));
      // random letters for EVERY face tile
      letterTiles.forEach(tile => {
        tile.textContent = randLetter();
        tile.animate(
          [
            { transform: "scale(.8)", opacity:.0 },
            { transform: "scale(1)",   opacity:1 }
          ],
          { duration: 220, easing: "cubic-bezier(.2,.8,.2,1)" }
        );
      });
      confettiBurst(120);
    }

    // initial state + intervals
    shuffleAll();
    setInterval(shuffleAll, 3000);
    shuffleBtn.addEventListener("click", shuffleAll);

    /* ===================== CONFETTI (canvas) ===================== */
    const cvs = document.getElementById("confetti");
    const ctx = cvs.getContext("2d");
    let W = cvs.width = innerWidth;
    let H = cvs.height = innerHeight;
    addEventListener("resize", () => {
      W = cvs.width = innerWidth;
      H = cvs.height = innerHeight;
    });

    const COLORS = [
      "#00ffab","#00e0ff","#ffd400","#ff6b6b","#7c4dff","#22d3ee","#34d399","#f59e0b","#60a5fa","#fb7185"
    ];
    const SHAPES = ["rect","circle","triangle"]; // variety
    const pieces = [];
    const MAX_PIECES = 220; // budget for perf

    function addPiece(x=Math.random()*W, y=-20, burst=false){
      const size = burst ? 6 + Math.random()*10 : 4 + Math.random()*6;
      pieces.push({
        x, y,
        w: size,
        h: size* (0.6 + Math.random()*0.6),
        r: Math.random()*Math.PI,
        vr: (Math.random()*0.1 + 0.05) * (Math.random()<.5 ? -1 : 1),
        vy: 1.2 + Math.random()*2.4,
        vx: (Math.random() - 0.5) * (burst ? 3.2 : 1.8),
        g: 0.015 + Math.random()*0.02,
        color: COLORS[rand(COLORS.length)],
        shape: SHAPES[rand(SHAPES.length)],
        life: burst ? 6000 : 9000, // ms lifetime cap
        born: performance.now()
      });
      if (pieces.length > MAX_PIECES) pieces.shift();
    }

    // Continuous gentle confetti rain
    setInterval(() => {
      for (let i=0;i<4;i++) addPiece(); // trickle
    }, 180);

    function confettiBurst(count=90){
      const cx = W* (0.35 + Math.random()*0.3); // center-ish
      const cy = H* (0.15 + Math.random()*0.2);
      for (let i=0;i<count;i++){
        const angle = Math.random()*Math.PI*2;
        const dist  = Math.random()*40;
        addPiece(cx + Math.cos(angle)*dist, cy + Math.sin(angle)*dist, true);
      }
    }

    function drawPiece(p){
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.r);

      ctx.fillStyle = p.color;
      switch(p.shape){
        case "rect":
          ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
          break;
        case "circle":
          ctx.beginPath(); ctx.arc(0,0, p.w*0.45, 0, Math.PI*2); ctx.fill();
          break;
        case "triangle":
          ctx.beginPath();
          ctx.moveTo(0,-p.h*0.6); ctx.lineTo(p.w*0.6, p.h*0.6); ctx.lineTo(-p.w*0.6, p.h*0.6); ctx.closePath();
          ctx.fill();
          break;
      }

      // subtle gloss
      ctx.globalAlpha = 0.18;
      ctx.fillStyle = "#ffffff";
      ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h*0.25);
      ctx.restore();
      ctx.globalAlpha = 1;
    }

    function tick(){
      ctx.clearRect(0,0,W,H);
      const now = performance.now();

      for (let i=pieces.length-1; i>=0; i--){
        const p = pieces[i];
        // physics
        p.vy += p.g;
        p.y  += p.vy;
        p.x  += p.vx + Math.sin((now + i*77)/900) * 0.3; // wind sway
        p.r  += p.vr;

        if (p.y > H + 40 || now - p.born > p.life){
          pieces.splice(i,1);
          continue;
        }
        drawPiece(p);
      }
      requestAnimationFrame(tick);
    }
    // First celebratory burst
    confettiBurst(140);
    tick();
  </script>
</body>
</html>
