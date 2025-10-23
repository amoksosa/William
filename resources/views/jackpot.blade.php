<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>3D Jackpot • Rapid Color Numbers + Colorful Cubes (Turbo Letters)</title>

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
            sweep:    { "0%": { transform:"translateX(-30%)" }, "100%": { transform:"translateX(30%)" } },
            bob:      { "0%": { transform:"translateY(0) rotateX(-10deg)" }, "50%": { transform:"translateY(-6px) rotateX(-10deg)" }, "100%": { transform:"translateY(0) rotateX(-10deg)" } },
            shine:    { "0%": { transform:"translateX(-140%) rotate(12deg)" }, "100%": { transform:"translateX(140%) rotate(12deg)" } }
          },
          animation: {
            ringSpin: "ringSpin 14s linear infinite",
            cubeSpin: "cubeSpin 10s linear infinite",
            flipIn:   "flipIn .35s cubic-bezier(.2,.8,.2,1)",
            twinkle:  "twinkle 3.2s ease-in-out infinite",
            sweep:    "sweep 18s ease-in-out infinite alternate",
            bob:      "bob 3.6s ease-in-out infinite",
            shine:    "shine .3s ease-out 1"
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

    /* ===== 3D CUBE: (kept, but not used now) ===== */
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
      background: radial-gradient(50% 100% at 50% 0%, rgba(0,0,0,.35), transparent 70%);
      filter: blur(6px);
    }

    /* Grid + aurora bg */
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

    /* Hover interactivity (kept for cubes, harmless) */
    .cube[data-active="true"]{
      animation-play-state: paused;
      transform: translateY(-4px) rotateX(-8deg) scale(1.02);
      box-shadow: 0 18px 40px rgba(0,0,0,.5), 0 0 24px rgba(255,255,255,.08);
    }

    /* ===== RNG LETTER BOX (namespaced to .rng-*) ===== */
    :root{
      --rng-hinge:#a8aeb7; --rng-hinge-dk:#79818c;
    }
    @keyframes rng-spinY { to { transform: translateY(calc(-1px * var(--rng-lh) * var(--rng-steps))); } }

    .rng-box { width:210px; }
    .rng-theme{ --rng-edge:#3b2a0f; --rng-p1:#ff8a1d; --rng-p1-hi:#ffa24f; --rng-p1-lo:#e56900; }
    .rng-theme.emerald{ --rng-edge:#0e7e5a; --rng-p1:#13c38b; --rng-p1-hi:#3ddeab; --rng-p1-lo:#0d9468; }
    .rng-theme.blue{ --rng-edge:#1a4aa9; --rng-p1:#2f7cff; --rng-p1-hi:#66a2ff; --rng-p1-lo:#1e55c4; }
    .rng-theme.violet{ --rng-edge:#5229a2; --rng-p1:#8a4bff; --rng-p1-hi:#a77bff; --rng-p1-lo:#5d2fb6; }

    .rng-lid,
    .rng-body,
    .rng-rim{ border:2px solid var(--rng-edge); border-radius:16px; }

    /* light transitions para smooth ang mabilis na color swaps */
    .rng-lid,
    .rng-body,
    .rng-window,
    .rng-reel,
    .rng-rim{
      transition: background .14s linear, box-shadow .14s linear, border-color .14s linear;
    }

    .rng-lid{
      height:74px;
      background: linear-gradient(180deg,var(--rng-p1-hi) 0%,var(--rng-p1) 14%,var(--rng-p1-lo) 100%);
      box-shadow: inset 0 8px 14px rgba(255,255,255,.22), inset 0 -12px 20px rgba(0,0,0,.22), 0 18px 36px -14px rgba(0,0,0,.28);
    }
    .rng-lip{
      position:absolute; inset:0.75rem; border-radius:12px;
      background: linear-gradient(180deg,var(--rng-p1-hi) 0%,var(--rng-p1) 30%,var(--rng-p1-lo) 100%);
      box-shadow: inset 0 8px 16px rgba(0,0,0,.40), 0 0 0 1px rgba(0,0,0,.06);
    }
    .rng-hinge{
      position:absolute; bottom:-6px; width:48px; height:10px; border-radius:4px;
      background: linear-gradient(180deg,#e7ebef 0%,var(--rng-hinge) 60%,var(--rng-hinge-dk) 100%);
      box-shadow: inset 0 2px 3px rgba(255,255,255,.5), inset 0 -2px 3px rgba(0,0,0,.25), 0 1px 3px rgba(0,0,0,.22);
    }
    .rng-body{
      margin-top:4px; padding:10px; border-radius:18px;
      background: linear-gradient(180deg,var(--rng-p1-hi) 0%,var(--rng-p1) 14%,var(--rng-p1-lo) 100%);
      box-shadow: inset 0 10px 18px rgba(255,255,255,.22), inset 0 -12px 18px rgba(0,0,0,.18), 0 14px 22px rgba(0,0,0,.16);
    }
    .rng-window{
      border-radius:12px; height:140px; overflow:hidden; position:relative;
      background: linear-gradient(180deg,var(--rng-p1-hi) 0%,var(--rng-p1) 30%,var(--rng-p1-lo) 100%);
      box-shadow: inset 0 8px 16px rgba(0,0,0,.40), 0 0 0 1px rgba(0,0,0,.06);
    }
    .rng-midline{ position:absolute; left:0; right:0; top:50%; height:2px; transform:translateY(-50%); background:rgba(255,255,255,.3); z-index:2; }

    .rng-reel{
      position:relative; height:112px; width:124px; border-radius:999px; overflow:hidden; border:2px solid var(--rng-edge);
      background: linear-gradient(180deg,rgba(255,255,255,.12) 0%,rgba(255,255,255,.06) 40%,rgba(0,0,0,.10) 100%), radial-gradient(65% 50% at 50% 20%, rgba(255,255,255,.20), transparent 60%), var(--rng-p1);
      box-shadow: inset 0 10px 18px rgba(255,255,255,.22), inset 0 -12px 18px rgba(0,0,0,.18), 0 14px 22px rgba(0,0,0,.16);
    }
    .rng-reel::after{
      content:""; position:absolute; inset:0; border-radius:999px; pointer-events:none;
      background: radial-gradient(80% 60% at 30% 20%,rgba(255,255,255,.28),transparent 55%), linear-gradient(180deg,rgba(255,255,255,.08),rgba(0,0,0,.06));
    }
    .rng-col{ position:absolute; left:0; right:0; top:0; display:flex; flex-direction:column; align-items:center;
      animation: rng-spinY var(--rng-speed,2200ms) linear infinite; will-change: transform; }
    .rng-letter{ font-weight:900; color:rgba(255,255,255,.95); font-size:1.9rem; letter-spacing:.18em; line-height: calc(1px * var(--rng-lh,44)); }

    .rng-rim{ margin-top:8px; border-radius:12px; background: linear-gradient(180deg,var(--rng-p1-hi),var(--rng-p1)); }
    .rng-rim > div { padding:.45rem 0; text-align:center; }
    /* ---- GIF dropped in place of RNG text ---- */
    .rng-logo{
      height:22px;               /* tuned to match the previous text size */
      max-width: 100%;
      width: auto;
      display:inline-block;
      vertical-align: middle;
      filter: drop-shadow(0 1px 0 rgba(0,0,0,.35));
      transform: translateY(1px); /* micro-align vertically */
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

    <!-- 4 BOXES: slightly higher (mt-10/md:mt-14) + synced fast color cycling -->
    <section class="mt-10 md:mt-14 preserve">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">

        <!-- BOX 1 -->
        <div class="w-40 h-40 relative">
          <div class="absolute inset-0 grid place-items-center">
            <div class="rng-box rng-theme" style="transform:scale(.60); transform-origin: top center;">
              <div class="relative mx-auto">
                <div class="rng-lid"></div>
                <div class="rng-lip"></div>
                <div class="rng-hinge" style="left:26%"></div>
                <div class="rng-hinge" style="right:26%"></div>
              </div>
              <div class="rng-body">
                <div class="p-1.5">
                  <div class="rng-window">
                    <div class="rng-midline"></div>
                    <div class="absolute inset-0 grid place-items-center">
                      <div class="rng-reel">
                        <!-- slowed a bit -->
                        <div class="rng-col" style="--rng-lh:44; --rng-steps:26; --rng-speed:3600ms">
                          <template id="rng-tpl-1"></template>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- GIF here -->
                <div class="rng-rim"><div>
                  <!-- UPDATE the src to your actual path -->
                  <img class="rng-logo" src="https://i.ibb.co/6RcL2yRP/logo-ezgif-com-crop.gif" alt="WILYONARYO logo">
                </div></div>
              </div>
            </div>
          </div>
        </div>

        <!-- BOX 2 -->
        <div class="w-40 h-40 relative">
          <div class="absolute inset-0 grid place-items-center">
            <div class="rng-box rng-theme emerald" style="transform:scale(.60); transform-origin: top center;">
              <div class="relative mx-auto">
                <div class="rng-lid"></div>
                <div class="rng-lip"></div>
                <div class="rng-hinge" style="left:26%"></div>
                <div class="rng-hinge" style="right:26%"></div>
              </div>
              <div class="rng-body">
                <div class="p-1.5">
                  <div class="rng-window">
                    <div class="rng-midline"></div>
                    <div class="absolute inset-0 grid place-items-center">
                      <div class="rng-reel">
                        <div class="rng-col" style="--rng-lh:44; --rng-steps:26; --rng-speed:3800ms">
                          <template id="rng-tpl-2"></template>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- GIF here -->
                <div class="rng-rim"><div>
                  <img class="rng-logo" src="https://i.ibb.co/6RcL2yRP/logo-ezgif-com-crop.gif" alt="WILYONARYO logo">
                </div></div>
              </div>
            </div>
          </div>
        </div>

        <!-- BOX 3 -->
        <div class="w-40 h-40 relative">
          <div class="absolute inset-0 grid place-items-center">
            <div class="rng-box rng-theme blue" style="transform:scale(.60); transform-origin: top center;">
              <div class="relative mx-auto">
                <div class="rng-lid"></div>
                <div class="rng-lip"></div>
                <div class="rng-hinge" style="left:26%"></div>
                <div class="rng-hinge" style="right:26%"></div>
              </div>
              <div class="rng-body">
                <div class="p-1.5">
                  <div class="rng-window">
                    <div class="rng-midline"></div>
                    <div class="absolute inset-0 grid place-items-center">
                      <div class="rng-reel">
                        <div class="rng-col" style="--rng-lh:44; --rng-steps:26; --rng-speed:3400ms">
                          <template id="rng-tpl-3"></template>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- GIF here -->
                <div class="rng-rim"><div>
                  <img class="rng-logo" src="https://i.ibb.co/6RcL2yRP/logo-ezgif-com-crop.gif" alt="WILYONARYO logo">
                </div></div>
              </div>
            </div>
          </div>
        </div>

        <!-- BOX 4 -->
        <div class="w-40 h-40 relative">
          <div class="absolute inset-0 grid place-items-center">
            <div class="rng-box rng-theme violet" style="transform:scale(.60); transform-origin: top center;">
              <div class="relative mx-auto">
                <div class="rng-lid"></div>
                <div class="rng-lip"></div>
                <div class="rng-hinge" style="left:26%"></div>
                <div class="rng-hinge" style="right:26%"></div>
              </div>
              <div class="rng-body">
                <div class="p-1.5">
                  <div class="rng-window">
                    <div class="rng-midline"></div>
                    <div class="absolute inset-0 grid place-items-center">
                      <div class="rng-reel">
                        <div class="rng-col" style="--rng-lh:44; --rng-steps:26; --rng-speed:3700ms">
                          <template id="rng-tpl-4"></template>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- GIF here -->
                <div class="rng-rim"><div>
                  <img class="rng-logo" src="https://i.ibb.co/6RcL2yRP/logo-ezgif-com-crop.gif" alt="WILYONARYO logo">
                </div></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Floor glow -->
    <div class="mt-14 h-28 relative">
      <div class="absolute left-1/2 -translate-x-1/2 top-4 w-[88%] h-10 rounded-full blur-3xl bg-emerald-400/25"></div>
      <div class="absolute left-1/2 -translate-x-1/2 top-11 w-[70%] h-8 rounded-full blur-3xl bg-cyan-400/25"></div>
    </div>
  </main>

  <!-- Controls removed as requested -->

  <!-- Logic -->
  <script>
    /* ===================== JACKPOT ===================== */
    let amount = 6000000;
    const amountEl = document.getElementById("amount");
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

    /* ===================== CUBES (kept; unused now) ===================== */
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
        face.style.backgroundImage = `linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,0) 35%), ${bg}`;
      });
      cube.querySelectorAll(".tile").forEach(tile=>{
        tile.style.background = p.tile;
        tile.style.color = p.text;
      });
    }

    const LETTER_INTERVAL_MS = 40;
    let letterTimer = null;

    function shuffleLetters(){
      letterTiles.forEach(tile=>{
        tile.textContent = randLetter();
        tile.style.transition = "transform 60ms ease";
        tile.style.transform = "translateZ(1px) scale(.98)";
        requestAnimationFrame(()=> { tile.style.transform = "translateZ(1px) scale(1)"; });
      });
    }

    cubes.forEach(c=>applyPalette(c, palettes[rand(palettes.length)]));
    shuffleLetters();
    letterTimer = setInterval(shuffleLetters, LETTER_INTERVAL_MS);

    const neonSets = [
      {c:"#22d3ee", glow:"0 0 8px rgba(34,211,238,.9),0 0 22px rgba(34,211,238,.55),0 0 44px rgba(34,211,238,.35)"},
      {c:"#60a5fa", glow:"0 0 8px rgba(96,165,250,.9),0 0 22px rgba(96,165,250,.55),0 0 44px rgba(96,165,250,.35)"},
      {c:"#34d399", glow:"0 0 8px rgba(52,211,153,.9),0 0 22px rgba(52,211,153,.55),0 0 44px rgba(52,211,153,.35)"},
      {c:"#f59e0b", glow:"0 0 8px rgba(245,158,11,.9),0 0 22px rgba(245,158,11,.55),0 0 44px rgba(245,158,11,.35)"},
      {c:"#fb7185", glow:"0 0 8px rgba(251,113,133,.9),0 0 22px rgba(251,113,133,.55),0 0 44px rgba(251,113,133,.35)"},
      {c:"#a78bfa", glow:"0 0 8px rgba(167,139,250,.9),0 0 22px rgba(167,139,250,.55),0 0 44px rgba(167,139,250,.35)"},
      {c:"#84cc16", glow:"0 0 8px rgba(132,204,22,.9),0 0 22px rgba(132,204,22,.55)"},
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

    function recolorCubes(){ cubes.forEach(cube => applyPalette(cube, palettes[rand(palettes.length)])); }

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
      const up = !!opts.up;
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

    // Ambient rain
    setInterval(()=>{ for (let i=0;i<4;i++) addPiece(); },180);

    function confettiBurst(count = 90){
      const cx = W * (0.35 + Math.random() * 0.3);
      const cy = H * (0.70 + Math.random() * 0.2);
      for (let i = 0; i < count; i++){
        const angle = Math.random() * Math.PI * 2;
        const dist = Math.random() * 40;
        addPiece(cx + Math.cos(angle) * dist, cy + Math.sin(angle) * dist, { up: true, burst: true });
      }
    }

    function centerOf(el){
      const r = el.getBoundingClientRect();
      const cx = r.left + r.width  / 2 + window.scrollX;
      const cy = r.top  + r.height / 2 + window.scrollY;
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

    const scene = document.querySelector('.scene');
    function tiltCube(e, cube){
      const rect = cube.getBoundingClientRect();
      const mx = (e.clientX - rect.left) / rect.width;
      const my = (e.clientY - rect.top)  / rect.height;
      const rx = (my - 0.5) * -14;
      const ry = (mx - 0.5) * 18;
      cube.style.transform = `translateY(-2px) rotateX(${rx - 10}deg) rotateY(${ry}deg) scale(1.02)`;
    }

    cubes.forEach(cube=>{
      cube.addEventListener('click', () => { burstFromElement(cube, 120); });
      cube.addEventListener('pointerenter', () => { cube.dataset.active = "true"; startTrickle(cube); });
      cube.addEventListener('pointermove', (e) => tiltCube(e, cube));
      cube.addEventListener('pointerleave', () => { stopTrickle(cube); cube.dataset.active = "false"; cube.style.transform = ""; });
      cube.addEventListener('touchstart', (e) => { burstFromElement(cube, 90); startTrickle(cube); setTimeout(()=> stopTrickle(cube), 800); }, {passive:true});
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

    confettiBurst(140);
    tick();

    /* ===================== RNG BOX: build A..Z for each reel ===================== */
    (function(){
      const alpha = [...'ABCDEFGHIJKLMNOPQRSTUVWXYZ'];
      function buildFrag(){
        const f = document.createDocumentFragment();
        const mk = ch => { const s = document.createElement('span'); s.className = 'rng-letter'; s.textContent = ch; return s; };
        for(let r=0;r<2;r++) alpha.forEach(ch => f.appendChild(mk(ch)));
        return f;
      }
      ['rng-tpl-1','rng-tpl-2','rng-tpl-3','rng-tpl-4'].forEach(id=>{
        const t = document.getElementById(id);
        if (t) t.replaceWith(buildFrag());
      });
    })();

    /* ===================== RNG BOX: synced fast color cycler ===================== */
    (function(){
      const boxes = Array.from(document.querySelectorAll('.rng-box'));
      if (!boxes.length) return;

      // Prebaked vivid palettes (edge + primary gradient stops)
      const boxPalettes = [
        {edge:'#0b6b6b', p1:'#06b6d4', hi:'#36d7ee', lo:'#0587a1'}, // cyan
        {edge:'#0a6a4b', p1:'#10b981', hi:'#39d9a4', lo:'#0b8a5f'}, // emerald
        {edge:'#163a8a', p1:'#3b82f6', hi:'#78a8ff', lo:'#2159c9'}, // blue
        {edge:'#3e2aa1', p1:'#6366f1', hi:'#9ea3ff', lo:'#3f41c9'}, // indigo
        {edge:'#5a2698', p1:'#8b5cf6', hi:'#b893ff', lo:'#6227cc'}, // violet
        {edge:'#7a1a67', p1:'#f472b6', hi:'#ffa1d4', lo:'#d14e99'}, // pink
        {edge:'#6e1a1a', p1:'#ef4444', hi:'#ff7a7a', lo:'#c52f2f'}, // red
        {edge:'#7a3b0f', p1:'#f59e0b', hi:'#ffcc66', lo:'#c97507'}, // orange
        {edge:'#7a6a0f', p1:'#eab308', hi:'#ffe266', lo:'#b49206'}, // yellow
        {edge:'#1f6a1a', p1:'#22c55e', hi:'#64e08e', lo:'#15803d'}  // green
      ];

      function applyPaletteToAll(p){
        boxes.forEach(el=>{
          el.style.setProperty('--rng-edge', p.edge);
          el.style.setProperty('--rng-p1',   p.p1);
          el.style.setProperty('--rng-p1-hi',p.hi);
          el.style.setProperty('--rng-p1-lo',p.lo);
        });
      }

      // Start in sync
      let idx = 0;
      applyPaletteToAll(boxPalettes[idx]);

      // Fast cycle (mabilis): every 220ms; sabay-sabay & same palette
      const SPEED_MS = 220;
      setInterval(()=>{
        idx = (idx + 1) % boxPalettes.length;
        applyPaletteToAll(boxPalettes[idx]);
      }, SPEED_MS);
    })();
  </script>
</body>
</html>
