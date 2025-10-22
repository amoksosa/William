<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Color Cycling Cubes + Embossed Letters</title>

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
            flipIn:   "flipIn .22s cubic-bezier(.2,.8,.2,1)",
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
    .neon-cyan{ color:var(--cyan); text-shadow:0 0 8px rgba(0,255,255,.9),0 0 22px rgba(0,255,255,.5),0 0 44px rgba(0,255,255,.35); }
    .neon-yellow{ color:var(--yellow); text-shadow:0 0 8px rgba(255,212,0,.9),0 0 22px rgba(255,212,0,.5),0 0 44px rgba(255,212,0,.35); }

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

    /* Prize pill uses CSS variables so we can recolor fast */
    .pill3d{
      --pillA:#22d3ee;
      --pillB:#a5f3fc;
      --pillBorder: rgba(34,211,238,.5);
      --pillGlow: rgba(34,211,238,.4);

      position:relative; transform-style:preserve-3d;
      background: linear-gradient(135deg, var(--pillA), var(--pillB));
      border: 1px solid var(--pillBorder);
      box-shadow: 0 10px 30px rgba(0,0,0,.4), 0 0 24px var(--pillGlow);
      transition: background .28s ease, border-color .28s ease, box-shadow .28s ease;
    }
    .pill3d::after{
      content:""; position:absolute; inset:0; border-radius:64px; transform:translateZ(-16px);
      background: radial-gradient(60% 60% at 50% 30%, rgba(255,255,255,.14), rgba(0,0,0,0) 60%); filter:blur(6px);
    }
    .flip{ animation:flipIn .22s cubic-bezier(.2,.8,.2,1); transform-origin:center bottom; }

    /* ================== ENHANCED 3D CUBE ================== */
    .cube{
      --front:#5eead4; --side:#2dd4bf; --top:#99f6e4; --tile:#e6fffb; --text:#111827;
      --depth:18; --stepZ:1px;
      --size:112px; --round:12px;

      position:relative; width:var(--size); height:var(--size);
      transform-style:preserve-3d;
      transition: transform .4s ease, box-shadow .35s ease;
    }
    /* Floor shadow */
    .cube::after{
      content:""; position:absolute; left:50%; transform:translateX(-50%);
      bottom:-18px; width:76%; height:16px; border-radius:999px;
      background: radial-gradient(ellipse at center, rgba(0,0,0,.45), rgba(0,0,0,0) 65%);
      filter: blur(8px);
    }

    .face{
      position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
      backface-visibility:hidden; border-radius:var(--round);
      background:
        radial-gradient(100% 140% at 20% 20%, rgba(255,255,255,.25), transparent 40%),
        linear-gradient(135deg, rgba(255,255,255,.10), rgba(255,255,255,0) 40%),
        radial-gradient(120% 120% at 50% 60%, rgba(0,0,0,.20), rgba(0,0,0,0) 55%),
        var(--_bg, #0ea5e9);
      box-shadow:
        0 0 0 1px rgba(0,0,0,.25) inset,
        0 1px 0 rgba(255,255,255,.08) inset,
        0 -3px 10px rgba(0,0,0,.25) inset,
        0 8px 24px rgba(0,0,0,.32);
      transition: background .28s ease;
    }
    .face::before{
      content:""; position:absolute; inset:0; border-radius:calc(var(--round) - 1px);
      box-shadow: 0 0 0 1px rgba(255,255,255,.20) inset, 0 0 0 2px rgba(0,0,0,.15) inset;
      pointer-events:none; mix-blend-mode:soft-light;
    }
    .face::after{
      content:""; position:absolute; inset:0; border-radius:calc(var(--round) - 2px);
      background:
        linear-gradient(to bottom, rgba(0,0,0,.18), transparent 28%),
        linear-gradient(to right, rgba(0,0,0,.12), transparent 30%),
        radial-gradient(120% 80% at 50% 100%, rgba(0,0,0,.25), transparent 55%);
      opacity:.55; pointer-events:none; mix-blend-mode:multiply;
    }

    .face.front  { transform: translateZ(calc(var(--size)/2)); }
    .face.back   { transform: rotateY(180deg) translateZ(calc(var(--size)/2)); }
    .face.right  { transform: rotateY( 90deg) translateZ(calc(var(--size)/2)); }
    .face.left   { transform: rotateY(-90deg) translateZ(calc(var(--size)/2)); }
    .face.top    { transform: rotateX( 90deg) translateZ(calc(var(--size)/2)); border-radius:12px 12px 10px 10px; }
    .face.bottom { transform: rotateX(-90deg) translateZ(calc(var(--size)/2)); }

    /* Tile + Embossed Letter */
    .tile{
      width:60%; height:60%; border-radius:14px;
      display:flex; align-items:center; justify-content:center;
      position:relative; transform-style:preserve-3d; overflow:hidden;
      background:
        linear-gradient(to bottom right, rgba(255,255,255,.18), rgba(255,255,255,0) 45%),
        radial-gradient(100% 100% at 50% 30%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%),
        var(--tile);
      box-shadow:
        0 10px 20px rgba(0,0,0,.30),
        0 2px 4px rgba(0,0,0,.25) inset,
        0 -4px 12px rgba(0,0,0,.25) inset,
        0 0 0 1px rgba(255,255,255,.18) inset;
      transition: background .28s ease;
    }
    .tile::before{
      content:""; position:absolute; inset:0; border-radius:14px;
      background: linear-gradient(180deg, rgba(255,255,255,.35), rgba(255,255,255,0) 46%);
      mix-blend-mode:screen; pointer-events:none;
    }
    .glyph3d{ position:relative; display:block; font-weight:900;
      font-size:2rem; line-height:1; letter-spacing:.06em; transform-style:preserve-3d; color:var(--text);
      filter: drop-shadow(0 1px 0 rgba(255,255,255,.22)) drop-shadow(0 10px 12px rgba(0,0,0,.30));
    }
    .glyph3d .layer{ position:absolute; inset:0; display:flex; align-items:center; justify-content:center; transform:translateZ(0); font-weight:900; }
    .glyph3d .layer.is-top{
      text-shadow: 0 1px 0 rgba(255,255,255,.25), 0 2px 0 rgba(0,0,0,.20), 0 8px 12px rgba(0,0,0,.30);
    }
    .glyph3d .layer.is-top.bevel::before,
    .glyph3d .layer.is-top.bevel::after{
      content: attr(data-char); position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-weight:900; pointer-events:none;
    }
    .glyph3d .layer.is-top.bevel::before{ transform: translate(-1px,-1px); color: rgba(255,255,255,.55); mix-blend-mode: screen; filter: blur(.2px); opacity:.7; }
    .glyph3d .layer.is-top.bevel::after { transform: translate(1.2px,1.2px);  color: rgba(0,0,0,.5);   mix-blend-mode: multiply; filter: blur(.2px); opacity:.85; }

    /* Background decoration */
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
      background: radial-gradient(circle at 35% 35%, rgba(255,255,255,.9), rgba(255,255,255,.0) 60%); opacity:.35; }
    .bokeh-dot.is-cyan { background: radial-gradient(circle at 35% 35%, rgba(64,255,245,.9), rgba(64,255,245,0) 60%); }
    .bokeh-dot.is-yellow { background: radial-gradient(circle at 35% 35%, rgba(255,227,96,.9), rgba(255,227,96,0) 60%); }

    /* Confetti canvas */
    #confetti { position: fixed; inset: 0; z-index: 30; pointer-events: none; }
  </style>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-dvh bg-[#070b16] bg-starfield text-white font-display overflow-hidden relative">

  <!-- Confetti -->
  <canvas id="confetti"></canvas>

  <!-- Decorative BG -->
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
    <!-- Neon Ring -->
    <div class="relative h-44 md:h-56 preserve">
      <div class="ring3d absolute left-1/2 -translate-x-1/2 top-2 w-[88%] md:w-[78%] aspect-[2.4/1] animate-ringSpin"
           style="transform: rotateX(25deg) translateZ(0)"></div>
    </div>

    <!-- Title + Prize -->
    <section class="text-center preserve">
      <h1 class="neon-yellow text-[clamp(2rem,6vw,5rem)] leading-none font-extrabold tracking-[.08em]">JACKPOT</h1>
      <h2 class="neon-yellow text-[clamp(1.6rem,5vw,3.8rem)] -mt-1 font-extrabold tracking-[.32em]">PRIZE</h2>

      <div id="prizePill"
           class="mt-6 md:mt-8 inline-flex items-center gap-3 rounded-[3rem] px-7 md:px-9 py-4 md:py-5 pill3d">
        <span class="text-white/90 text-[clamp(1.3rem,3.6vw,2.4rem)] font-extrabold">₱</span>
        <span id="amount" class="text-white text-[clamp(1.9rem,5.5vw,3.3rem)] font-extrabold tabular-nums tracking-wider">6,000,000</span>
        <span id="pillDot" class="ml-2 inline-block w-3 h-3 rounded-full border"></span>
      </div>

      <p class="mt-3 text-white/60 text-sm">This might be your lucky day!</p>
    </section>

    <!-- CUBES -->
    <section class="mt-12 md:mt-16 preserve">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 place-items-center">

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

    /* ===================== CUBES + LETTERS ===================== */
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const cubes = Array.from(document.querySelectorAll("[data-cube]"));
    const letterTiles = Array.from(document.querySelectorAll("[data-letter]"));

    // BIG & BRIGHT palettes (front/side/top/tile/text) + pill gradient colors
    const palettes = [
      {front:"#22d3ee", side:"#06b6d4", top:"#a5f3fc", tile:"#e6fdff", text:"#071a1d", pillA:"#22d3ee", pillB:"#a5f3fc"},
      {front:"#34d399", side:"#10b981", top:"#bbf7d0", tile:"#eafff3", text:"#062016", pillA:"#10b981", pillB:"#34d399"},
      {front:"#60a5fa", side:"#3b82f6", top:"#93c5fd", tile:"#e8f1ff", text:"#0b1220", pillA:"#3b82f6", pillB:"#60a5fa"},
      {front:"#f472b6", side:"#e879f9", top:"#f5d0fe", tile:"#fff0fb", text:"#280a22", pillA:"#e879f9", pillB:"#f472b6"},
      {front:"#f59e0b", side:"#ef4444", top:"#fde68a", tile:"#fff7e5", text:"#1a1305", pillA:"#ef4444", pillB:"#f59e0b"},
      {front:"#a78bfa", side:"#6366f1", top:"#ddd6fe", tile:"#f1efff", text:"#0f1022", pillA:"#6366f1", pillB:"#a78bfa"},
      {front:"#fb7185", side:"#f43f5e", top:"#fecdd3", tile:"#fff1f3", text:"#22060a", pillA:"#f43f5e", pillB:"#fb7185"},
      {front:"#84cc16", side:"#22c55e", top:"#d9f99d", tile:"#f3ffe6", text:"#0d1b09", pillA:"#22c55e", pillB:"#84cc16"},
      {front:"#06b6d4", side:"#0ea5e9", top:"#bae6fd", tile:"#e8f7ff", text:"#07141c", pillA:"#0ea5e9", pillB:"#06b6d4"},
      {front:"#f97316", side:"#fb7185", top:"#fed7aa", tile:"#fff1e6", text:"#2a0f06", pillA:"#fb7185", pillB:"#f97316"}
    ];

    const rand = n => Math.floor(Math.random()*n);
    const randLetter = () => letters[rand(letters.length)];

    const applyPaletteToCube = (cube, p) => {
      cube.style.setProperty("--front", p.front);
      cube.style.setProperty("--side",  p.side);
      cube.style.setProperty("--top",   p.top);
      cube.style.setProperty("--tile",  p.tile);
      cube.style.setProperty("--text",  p.text);

      // Color the six faces (base gradient differs per orientation)
      const faces = cube.querySelectorAll(".face");
      faces.forEach(face => {
        const isTop = face.classList.contains("top");
        const isBottom = face.classList.contains("bottom");
        let bg;
        if (isTop)       bg = `linear-gradient(180deg, ${p.top}, ${p.front})`;
        else if (isBottom) bg = `linear-gradient(0deg, #0b1022, #0f172a)`;
        else             bg = `linear-gradient(135deg, ${p.front}, ${p.side})`;
        face.style.setProperty("--_bg", bg);
      });
    };

    // ===== Embossed 3D glyph builder =====
    function buildGlyph3D(char, textColor, depth=18, stepZ=1){
      const wrap = document.createElement("span");
      wrap.className = "glyph3d";
      for(let i=depth; i>=1; i--){
        const layer = document.createElement("span");
        layer.className = "layer";
        layer.textContent = char;
        const shade = Math.max(0, 30 - i*1.5);
        layer.style.color = `hsl(215 28% ${shade}%)`;
        layer.style.transform = `translateZ(${-i*stepZ}px)`;
        wrap.appendChild(layer);
      }
      const top = document.createElement("span");
      top.className = "layer is-top bevel";
      top.setAttribute("data-char", char);
      top.textContent = char;
      top.style.color = textColor;
      wrap.appendChild(top);
      return wrap;
    }

    function setTileLetter(tile, ch){
      tile.innerHTML = "";
      const styles = getComputedStyle(tile.closest(".cube"));
      const textColor = styles.getPropertyValue("--text")?.trim() || "#111827";
      const depth = parseInt(styles.getPropertyValue("--depth")) || 18;
      const step  = parseFloat(styles.getPropertyValue("--stepZ")) || 1;
      tile.appendChild(buildGlyph3D(ch, textColor, depth, step));
      tile.animate(
        [{ transform:"translateZ(0) scale(.9) rotateX(8deg)", opacity:.0 },
         { transform:"translateZ(0) scale(1) rotateX(0)",     opacity:1 }],
        { duration: 160, easing: "cubic-bezier(.2,.8,.2,1)" }
      );
    }

    function shuffleLetters(){
      letterTiles.forEach(tile => setTileLetter(tile, randLetter()));
    }

    // initial letters
    shuffleLetters();
    let letterTimer = setInterval(shuffleLetters, 900);
    shuffleBtn.addEventListener("click", () => {
      shuffleLetters();
      clearInterval(letterTimer);
      letterTimer = setInterval(shuffleLetters, 900);
    });

    /* ===================== FAST COLOR CYCLER (0.5s) ===================== */
    const prizePill = document.getElementById("prizePill");
    const pillDot   = document.getElementById("pillDot");

    function applyPrizePalette(p){
      prizePill.style.setProperty("--pillA", p.pillA);
      prizePill.style.setProperty("--pillB", p.pillB);
      prizePill.style.setProperty("--pillBorder", p.pillA + "80".slice(0)); // soft alpha tweak
      prizePill.style.setProperty("--pillGlow", p.pillA + "66".slice(0));
      pillDot.style.borderColor = p.pillA;
      pillDot.style.boxShadow = `0 0 10px ${p.pillA}, 0 0 22px ${p.pillB}`;
      pillDot.style.background = `radial-gradient(circle at 40% 40%, ${p.pillB}, ${p.pillA})`;
      pillDot.style.transition = "background .28s ease, box-shadow .28s ease, border-color .28s ease";
    }

    function cycleColors(){
      // randomize each cube individually for a rainbow wall
      cubes.forEach(cube => applyPaletteToCube(cube, palettes[rand(palettes.length)]));
      // randomize prize pill too
      applyPrizePalette(palettes[rand(palettes.length)]);
    }

    // kick off with vivid colors
    cycleColors();
    setInterval(cycleColors, 500); // << every 0.5s color change

    /* ===================== CONFETTI (canvas) ===================== */
    const cvs = document.getElementById("confetti");
    const ctx = cvs.getContext("2d");
    let W = cvs.width = innerWidth, H = cvs.height = innerHeight;
    addEventListener("resize", () => { W = cvs.width = innerWidth; H = cvs.height = innerHeight; });

    const COLORS = ["#00ffab","#00e0ff","#ffd400","#ff6b6b","#7c4dff","#22d3ee","#34d399","#f59e0b","#60a5fa","#fb7185"];
    const SHAPES = ["rect","circle","triangle"];
    const pieces = [];
    const MAX_PIECES = 220;

    function addPiece(x=Math.random()*W, y=-20, burst=false){
      const size = burst ? 6 + Math.random()*10 : 4 + Math.random()*6;
      pieces.push({
        x, y, w:size, h:size*(0.6+Math.random()*0.6),
        r: Math.random()*Math.PI, vr:(Math.random()*0.1+0.05)*(Math.random()<.5?-1:1),
        vy: 1.2 + Math.random()*2.4, vx:(Math.random()-0.5)*(burst?3.2:1.8),
        g: 0.015 + Math.random()*0.02, color: COLORS[rand(COLORS.length)],
        shape: SHAPES[rand(SHAPES.length)], life: burst?6000:9000, born: performance.now()
      });
      if (pieces.length > MAX_PIECES) pieces.shift();
    }
    setInterval(()=>{ for (let i=0;i<4;i++) addPiece(); },180);

    function confettiBurst(count=90){
      const cx = W*(0.35 + Math.random()*0.3), cy = H*(0.15 + Math.random()*0.2);
      for (let i=0;i<count;i++){
        const angle = Math.random()*Math.PI*2, dist = Math.random()*40;
        addPiece(cx + Math.cos(angle)*dist, cy + Math.sin(angle)*dist, true);
      }
    }

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
        p.vy += p.g; p.y += p.vy; p.x += p.vx + Math.sin((now + i*77)/900)*0.3; p.r += p.vr;
        if (p.y > H + 40 || now - p.born > p.life){ pieces.splice(i,1); continue; }
        drawPiece(p);
      }
      requestAnimationFrame(tick);
    }
    confettiBurst(140); tick();
  </script>
</body>
</html>
