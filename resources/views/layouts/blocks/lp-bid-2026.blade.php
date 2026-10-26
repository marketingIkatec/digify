<style>
    /* Digify — design system extraído de digify.com.br */
    /* Fontes hospedadas na própria página (subconjunto latino) */
    @font-face {
        font-family: "Plus Jakarta Sans";
        font-style: normal;
        font-weight: 200 800;
        font-display: swap;
        src: url("assets/fonts/plus-jakarta-sans.woff2") format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    :root {
        --blue: #0A50FF;
        --sky: #55B0FF;
        --navy: #0D1B35;
        --navy-2: #13254A;
        --ink: #1E2D4A;
        --muted: #5A6A85;
        --teal: #18C7A8;
        --amber: #FFB21A;
        --pink: #FF5C7A;
        --soft: #F5F8FF;
        --soft-2: #EEF3FD;
        --line: #DDE5F0;
        --white: #fff;
        --grad: linear-gradient(135deg, var(--blue) 0%, var(--sky) 100%);
        --shadow: 0 24px 60px -20px rgba(13, 27, 53, .3);
        --font: "Plus Jakarta Sans", system-ui, sans-serif;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: var(--font);
        color: var(--ink);
        background: var(--white);
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
    }

    img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    a {
        color: inherit;
    }

    h1,
    h2,
    h3 {
        text-wrap: balance;
    }

    p,
    li,
    small,
    blockquote {
        text-wrap: pretty;
    }

    .container {
        width: min(1200px, 100% - 40px);
        margin-inline: auto;
        line-height: 1.6;
    }

    .grad {
        background: var(--grad);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .grad--light {
        background-image: linear-gradient(90deg, var(--sky), var(--teal));
    }

    .kicker {
        display: inline-block;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .22em;
        text-transform: uppercase;
        color: var(--sky);
    }

    .kicker--blue {
        color: var(--blue);
    }

    .kicker--light {
        color: var(--teal);
    }

    /* Botões */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 17px 30px;
        border: 0;
        border-radius: 999px;
        cursor: pointer;
        font: 800 15px/1 var(--font);
        letter-spacing: .02em;
        text-decoration: none;
        color: var(--white);
        background: var(--grad);
        box-shadow: 0 14px 30px -10px rgba(10, 80, 255, .7);
        transition: transform .2s, box-shadow .2s;
    }

    .btn:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 20px 38px -12px rgba(10, 80, 255, .8);
    }

    .btn:disabled {
        opacity: .6;
        cursor: default;
        transform: none;
    }

    .btn--sm {
        padding: 11px 20px;
        font-size: 14px;
    }

    .btn--block {
        width: 100%;
        margin-top: 4px;
    }

    .btn--light {
        background: var(--white);
        color: var(--blue);
        box-shadow: 0 16px 40px -12px rgba(85, 176, 255, .8);
    }

    /* Topbar */
    .topbar {
        position: absolute;
        inset: 0 0 auto;
        z-index: 20;
    }

    .topbar__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 84px;
    }

    .topbar__logo {
        height: 40px;
        width: auto;
    }

    /* ============ DOBRA 1 ============ */
    .hero {
        position: relative;
        padding: 7rem 0 90px;
        background: var(--navy);
        color: #C3D0E8;
        overflow: hidden;
        isolation: isolate;
    }

    .hero__bg {
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    .hero__bg::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(700px 500px at 80% 0%, rgba(10, 80, 255, .55), transparent 65%),
            radial-gradient(600px 420px at 0% 100%, rgba(24, 199, 168, .22), transparent 65%);
    }

    .hero__bg::after {
        content: "";
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(255, 255, 255, .05) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .05) 1px, transparent 1px);
        background-size: 64px 64px;
        mask-image: radial-gradient(ellipse at 50% 30%, #000 20%, transparent 75%);
    }

    .hero__top {
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 64px;
        align-items: center;
    }

    .hero__copy {
        position: relative;
    }

    .hero h1 {
        margin: 18px 0 24px;
        font-size: clamp(40px, 6vw, 78px);
        line-height: 1.02;
        font-weight: 800;
        letter-spacing: -.045em;
        color: var(--white);
    }

    .hl {
        font-style: normal;
        position: relative;
        white-space: nowrap;
    }

    .hl--start {
        color: var(--sky);
    }

    .hl--end {
        color: var(--navy);
        z-index: 0;
        padding: 0 .12em;
    }

    .hl--end::before {
        content: "";
        position: absolute;
        inset: .1em -.02em .02em;
        z-index: -1;
        border-radius: .18em;
        background: linear-gradient(90deg, var(--teal), #4BE3C4);
        transform: rotate(-1.5deg);
    }

    .lead {
        max-width: 560px;
        font-size: 20px;
    }


    /* Formulário */
    .form-card {
        position: relative;
        padding: 30px;
        border-radius: 28px;
        background: var(--white);
        color: var(--ink);
        box-shadow: 0 50px 100px -30px rgba(0, 0, 0, .6), 0 0 0 6px rgba(255, 255, 255, .08);
        transform: rotate(1.2deg);
        transition: transform .4s;
    }

    .form-card:hover,
    .form-card:focus-within {
        transform: rotate(0);
    }

    .form-card__head {
        margin-bottom: 18px;
    }

    .form-card__pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color: var(--blue);
        background: var(--soft-2);
    }

    .form-card__pill::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--sky);
    }

    .form-card h2 {
        margin-top: 10px;
        font-size: 26px;
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.03em;
        color: var(--navy);
    }

    .lead-form {
        display: grid;
        gap: 12px;
    }

    .lead-form__row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .lead-form label {
        gap: 6px;
        font-size: 13px;
        color: var(--navy);
    }

    .lead-form input {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1.5px solid var(--line);
        font: 500 15px var(--font);
        color: var(--ink);
        background: var(--soft);
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .lead-form input:focus {
        outline: none;
        border-color: var(--blue);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(10, 80, 255, .12);
    }

    .form-success {
        padding: 12px 14px;
        border-radius: 28px;
        background: rgba(24, 199, 168, .12);
        color: #0E8A74;
        font-weight: 700;
        font-size: 14px;
    }

    /* Quadro animado */
    .board {
        margin-top: 72px;
        padding: 16px;
        border-radius: 26px;
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .1);
    }

    .board__scroll {
        overflow-x: auto;
        scrollbar-width: none;
    }

    .board__scroll::-webkit-scrollbar {
        display: none;
    }

    .board__lanes {
        position: relative;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        min-width: 880px;
    }

    .lane {
        display: grid;
        align-content: start;
        gap: 10px;
        padding: 6px 6px 120px;
    }

    .lane header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .06);
        border-top: 3px solid var(--c);
    }

    .lane header b {
        flex: 1;
        color: var(--white);
        font-size: 14px;
    }

    .lane__ic {
        display: grid;
        place-items: center;
        width: 28px;
        height: 28px;
        margin-right: 10px;
        border-radius: 9px;
        color: var(--c);
        background: color-mix(in srgb, var(--c) 18%, transparent);
    }

    .lane__ic svg {
        width: 16px;
        height: 16px;
    }

    .lane header span {
        display: grid;
        place-items: center;
        min-width: 24px;
        height: 24px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color: var(--navy);
        background: var(--c);
    }

    .deal {
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .deal strong {
        display: block;
        font-size: 14px;
        color: var(--white);
    }

    .deal small {
        font-size: 12px;
        color: #8FA3C6;
    }

    .deal--ghost {
        opacity: .5;
    }

    .traveler {
        position: absolute;
        left: 0;
        bottom: 6px;
        width: 25%;
        padding: 6px;
        animation: travel 11s cubic-bezier(.65, 0, .35, 1) infinite;
        will-change: transform;
    }

    .traveler__card {
        padding: 14px;
        border-radius: 16px;
        background: var(--white);
        box-shadow: 0 20px 40px -12px rgba(10, 80, 255, .7), 0 0 0 2px var(--sky);
        animation: glow 11s infinite;
    }

    .traveler__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .traveler__top strong {
        color: var(--navy);
        font-size: 15px;
    }

    .traveler small {
        font-size: 12px;
        color: var(--muted);
    }

    .traveler__won {
        padding: 3px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        color: var(--white);
        background: var(--teal);
        opacity: 0;
        animation: won 11s infinite;
    }

    .traveler__bar {
        height: 6px;
        margin-top: 10px;
        border-radius: 99px;
        background: var(--soft-2);
        overflow: hidden;
    }

    .traveler__bar i {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: var(--grad);
        transform-origin: left;
        animation: progress 11s cubic-bezier(.65, 0, .35, 1) infinite;
    }

    /* ============ DOBRA 2 ============ */
    .steps {
        padding: 120px 0;
        background: var(--soft);
    }

    .steps__grid {
        display: grid;
        grid-template-columns: .9fr 1.1fr;
        gap: 72px;
        align-items: center;
    }

    .steps h2 {
        margin: 14px 0 18px;
        font-size: clamp(32px, 4.2vw, 52px);
        line-height: 1.05;
        font-weight: 800;
        letter-spacing: -.04em;
        color: var(--navy);
    }

    .steps p {
        font-size: 18px;
        color: var(--muted);
    }

    .ticks {
        list-style: none;
        display: grid;
        gap: 14px;
        margin-top: 32px;
    }

    .ticks li {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 17px;
        font-weight: 700;
        color: var(--navy);
    }

    .ticks span {
        display: grid;
        place-items: center;
        flex: none;
        width: 44px;
        height: 44px;
        border-radius: 14px;
        color: var(--white);
        background: var(--c);
        box-shadow: 0 10px 20px -8px var(--c);
    }

    .ticks svg {
        width: 22px;
        height: 22px;
    }

    .todo {
        padding: 26px;
        border-radius: 28px;
        background: var(--white);
        box-shadow: 0 50px 100px -40px rgba(13, 27, 53, .4), 0 0 0 1px var(--line);
    }

    .todo__head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }

    .todo__head small {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .todo__head strong {
        display: block;
        font-size: 22px;
        letter-spacing: -.02em;
        color: var(--navy);
    }

    .todo__score {
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        color: #0E8A74;
        background: rgba(24, 199, 168, .12);
        white-space: nowrap;
    }

    .todo__score b {
        font-size: 18px;
    }

    .todo__hint {
        margin: 10px 0 18px;
        font-size: 14px !important;
    }

    .opp {
        position: relative;
        padding: 16px 18px;
        margin-top: 12px;
        border-radius: 18px;
        border: 1.5px solid var(--line);
        background: var(--white);
        transition: border-color .3s, background .3s, transform .3s;
    }

    .opp:hover {
        border-color: rgba(10, 80, 255, .35);
        transform: translateX(-4px);
    }

    .opp__meta {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: var(--muted);
    }

    .opp__meta span {
        margin-left: auto;
    }

    .opp__owner {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .opp__meta strong {
        color: var(--navy);
        font-size: 15px;
    }

    .opp__step {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
    }

    .opp__icon {
        display: grid;
        place-items: center;
        flex: none;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        color: var(--blue);
        background: var(--soft-2);
    }

    .opp__icon svg {
        width: 18px;
        height: 18px;
    }

    .opp.is-won .opp__icon {
        color: #0E8A74;
        background: rgba(24, 199, 168, .14);
    }

    .opp__step p {
        flex: 1;
        margin: 0;
        font-size: 15px !important;
        font-weight: 600;
        color: var(--ink) !important;
    }

    .opp__step button {
        flex: none;
        padding: 9px 16px;
        border: 0;
        border-radius: 999px;
        cursor: pointer;
        font: 800 13px var(--font);
        color: var(--white);
        background: var(--blue);
        transition: transform .2s, background .2s;
    }

    .opp__step button:hover {
        transform: scale(1.06);
    }

    .opp__step button:disabled {
        cursor: default;
        background: var(--teal);
        transform: none;
    }

    .opp__bar {
        height: 5px;
        margin-top: 12px;
        border-radius: 99px;
        background: var(--soft-2);
        overflow: hidden;
    }

    .opp__bar i {
        display: block;
        height: 100%;
        width: 0;
        border-radius: inherit;
        background: var(--grad);
        transition: width .6s cubic-bezier(.2, .8, .2, 1);
    }

    .opp.is-tick .opp__step p {
        animation: swap .5s;
    }

    .opp.is-won {
        border-color: var(--teal);
        background: linear-gradient(90deg, rgba(24, 199, 168, .08), var(--white));
    }

    .opp.is-won .opp__bar i {
        background: var(--teal);
    }

    /* ============ DOBRA 3 ============ */
    .sync {
        position: relative;
        padding: 120px 0;
        background: radial-gradient(800px 500px at 50% 0%, rgba(10, 80, 255, .55), transparent 70%), var(--navy);
        color: #C3D0E8;
        overflow: hidden;
    }

    .sync__head {
        max-width: 780px;
        margin: 0 auto;
        text-align: center;
    }

    .sync h2 {
        margin: 14px 0 18px;
        font-size: clamp(32px, 4.6vw, 58px);
        line-height: 1.04;
        font-weight: 800;
        letter-spacing: -.04em;
        color: var(--white);
    }

    .sync__head p {
        font-size: 18px;
    }

    .sync__stage {
        display: grid;
        grid-template-columns: 1fr 140px 1fr;
        align-items: stretch;
        margin-top: 64px;
    }

    .app {
        display: flex;
        flex-direction: column;
        border-radius: 26px;
        overflow: hidden;
        box-shadow: 0 50px 100px -40px rgba(0, 0, 0, .7), 0 0 0 1px rgba(255, 255, 255, .1);
    }

    .app__bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
        padding: 0 22px;
        font-size: 13px;
        font-weight: 700;
        color: rgba(255, 255, 255, .8);
    }

    .app__bar img {
        height: 30px;
        width: auto;
    }

    .app__bar--sac {
        background: var(--blue);
    }

    .app__bar--fy {
        background: #08132A;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    /* lado Digisac: WhatsApp */
    .app--sac {
        background: #EFEAE2;
    }

    .wa-contact {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        color: var(--white);
        background: #008069;
    }

    .wa-contact>img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .wa-contact b {
        display: block;
        font-size: 15px;
    }

    .wa-contact small {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        opacity: .9;
    }

    .wa-contact small img {
        width: 14px;
        height: 14px;
        padding: 1px;
        border-radius: 4px;
        background: #25D366;
    }

    .app__chat {
        flex: 1;
        display: grid;
        align-content: start;
        gap: 8px;
        min-height: 220px;
        padding: 18px 22px;
        background-color: #EFEAE2;
        background-image: radial-gradient(rgba(0, 0, 0, .045) 1.2px, transparent 1.4px);
        background-size: 16px 16px;
    }

    .b {
        position: relative;
        max-width: 82%;
        padding: 7px 10px 8px;
        border-radius: 8px;
        font-size: 14px;
        line-height: 1.4;
        color: #111B21;
        box-shadow: 0 1px .5px rgba(11, 20, 26, .13);
        opacity: 0;
        animation: pop1 10s infinite;
    }

    .b--in {
        justify-self: start;
        background: #FFFFFF;
        border-top-left-radius: 0;
    }

    .b--out {
        justify-self: end;
        background: #D9FDD3;
        border-top-right-radius: 0;
    }

    .b--in::before,
    .b--out::before {
        content: "";
        position: absolute;
        top: 0;
        width: 8px;
        height: 13px;
    }

    .b--in::before {
        left: -8px;
        background: #FFFFFF;
        clip-path: polygon(0 0, 100% 0, 100% 100%);
    }

    .b--out::before {
        right: -8px;
        background: #D9FDD3;
        clip-path: polygon(0 0, 100% 0, 0 100%);
    }

    .b2 {
        animation-name: pop2;
    }

    .b3 {
        animation-name: pop3;
    }

    .tm {
        float: right;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin: 8px 0 -4px 10px;
        font-size: 11px;
        color: #667781;
    }

    .tick {
        width: 16px;
        height: 16px;
        fill: #53BDEB;
    }

    .app__action {
        padding: 12px 18px 16px;
        background: #F0F2F5;
        border-top: 1px solid rgba(0, 0, 0, .06);
    }

    .send {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        height: 46px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 800;
        color: var(--white);
        background: var(--navy);
        animation: press 10s infinite;
    }

    .send>img {
        width: 20px;
        height: 20px;
    }

    .send__a,
    .send__b {
        transition: none;
    }

    .send__label {
        display: grid;
    }

    .send__label>span {
        grid-area: 1 / 1;
    }

    .send__b {
        opacity: 0;
        animation: sent 10s infinite;
    }

    .send__a {
        animation: unsent 10s infinite;
    }

    /* ligação */
    .link {
        position: relative;
        display: grid;
        place-items: center;
    }

    .link__line {
        width: 100%;
        height: 3px;
        border-radius: 3px;
        background: repeating-linear-gradient(90deg, rgba(85, 176, 255, .8) 0 10px, transparent 10px 18px);
        background-size: 18px 3px;
        animation: dash .6s linear infinite;
    }

    .link__fly {
        position: absolute;
        top: 50%;
        left: 0;
        width: 52px;
        height: 52px;
        margin-top: -26px;
        border-radius: 50%;
        box-shadow: 0 0 0 4px var(--white), 0 0 30px 6px rgba(85, 176, 255, .8);
        opacity: 0;
        animation: fly 10s infinite;
    }

    .link__fly img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    /* lado Digify: funil */
    .app--fy {
        background: #0F1F3D;
    }

    .col {
        flex: 1;
        display: grid;
        align-content: start;
        gap: 10px;
        padding: 18px;
    }

    .col__head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 14px;
        color: var(--sky);
        background: rgba(255, 255, 255, .06);
        border-top: 3px solid var(--sky);
    }

    .col__head svg {
        width: 18px;
        height: 18px;
    }

    .col__head b {
        flex: 1;
        font-size: 14px;
        color: var(--white);
    }

    .col__count {
        display: grid;
        place-items: center;
        min-width: 24px;
        height: 24px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color: var(--navy);
        background: var(--sky);
    }

    .col__count::after {
        content: "2";
        animation: count 10s infinite;
    }

    .newdeal {
        display: grid;
        grid-template-rows: 0fr;
        animation: grow 10s infinite;
    }

    .newdeal__inner {
        overflow: hidden;
        min-height: 0;
    }

    .newdeal__card {
        display: grid;
        gap: 12px;
        padding: 14px;
        border-radius: 16px;
        background: var(--white);
        border: 2px solid var(--teal);
        border-top-width: 5px;
    }

    .newdeal__top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .newdeal__top>img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
    }

    .newdeal__top div {
        flex: 1;
    }

    .newdeal__top small {
        display: block;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--blue);
    }

    .newdeal__top strong {
        color: var(--navy);
        font-size: 16px;
    }

    .newdeal__owner {
        width: 30px !important;
        height: 30px !important;
    }

    .newdeal__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .tg {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--blue);
        background: var(--soft-2);
    }

    .tg img {
        width: 16px;
        height: 16px;
        padding: 2px;
        border-radius: 5px;
        background: #25D366;
    }

    .tg svg {
        width: 14px;
        height: 14px;
    }

    .tg--wa {
        color: #0E7A3D;
        background: #DCF8E3;
    }

    .newdeal__next {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding-top: 10px;
        border-top: 1px dashed var(--line);
        font-size: 12.5px;
        color: var(--muted);
    }

    .newdeal__next b {
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 12px;
        color: #9A6400;
        background: rgba(255, 178, 26, .22);
    }

    .olddeal {
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .olddeal strong {
        display: block;
        font-size: 14px;
        color: var(--white);
    }

    .olddeal small {
        font-size: 12px;
        color: #8FA3C6;
    }

    .olddeal--ghost {
        opacity: .5;
    }

    .sync__cta {
        margin-top: 56px;
        text-align: center;
    }

    /* Rodapé */
    .footer {
        padding: 28px 0;
        border-top: 1px solid var(--line);
    }

    .footer__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        color: var(--muted);
    }

    .footer__logo {
        height: 32px;
        width: auto;
    }

    .footer__inner a {
        text-decoration: none;
        font-weight: 700;
    }

    /* Desempenho: seções fora da tela não são renderizadas e suas animações ficam pausadas */
    .lazy-section {
        content-visibility: auto;
        contain-intrinsic-size: auto 900px;
    }

    .is-paused,
    .is-paused * {
        animation-play-state: paused !important;
    }

    /* Animações */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity .8s ease, transform .8s ease;
    }

    .reveal.is-in {
        opacity: 1;
        transform: none;
    }

    @keyframes rotate {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes travel {
        0% {
            transform: none;
            opacity: 0;
        }

        4% {
            opacity: 1;
        }

        18% {
            transform: none;
        }

        26%,
        42% {
            transform: translateX(100%);
        }

        50%,
        66% {
            transform: translateX(200%);
        }

        74%,
        94% {
            transform: translateX(300%);
            opacity: 1;
        }

        100% {
            transform: translateX(300%);
            opacity: 0;
        }
    }

    @keyframes progress {

        0%,
        18% {
            transform: scaleX(.25);
        }

        26%,
        42% {
            transform: scaleX(.5);
        }

        50%,
        66% {
            transform: scaleX(.75);
        }

        74%,
        100% {
            transform: none;
        }
    }

    @keyframes won {

        0%,
        74% {
            opacity: 0;
            transform: scale(.6);
        }

        78%,
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes glow {

        0%,
        74% {
            box-shadow: 0 20px 40px -12px rgba(10, 80, 255, .7), 0 0 0 2px var(--sky);
        }

        78%,
        100% {
            box-shadow: 0 20px 50px -10px rgba(24, 199, 168, .9), 0 0 0 3px var(--teal);
        }
    }

    @keyframes swap {
        0% {
            opacity: 0;
            transform: translateY(8px);
        }

        100% {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes dash {
        to {
            background-position: 18px 0;
        }
    }

    @keyframes pop1 {

        0%,
        3% {
            opacity: 0;
            transform: translateY(10px);
        }

        7%,
        94% {
            opacity: 1;
            transform: none;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes pop2 {

        0%,
        13% {
            opacity: 0;
            transform: translateY(10px);
        }

        17%,
        94% {
            opacity: 1;
            transform: none;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes pop3 {

        0%,
        23% {
            opacity: 0;
            transform: translateY(10px);
        }

        27%,
        94% {
            opacity: 1;
            transform: none;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes press {

        0%,
        31% {
            transform: none;
            background: var(--navy);
            box-shadow: none;
        }

        33% {
            transform: scale(.94);
            background: var(--blue);
            box-shadow: 0 0 0 8px rgba(85, 176, 255, .35);
        }

        36%,
        94% {
            transform: none;
            background: var(--teal);
            box-shadow: none;
        }

        100% {
            background: var(--navy);
        }
    }

    @keyframes unsent {

        0%,
        34% {
            opacity: 1;
        }

        36%,
        96% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes sent {

        0%,
        34% {
            opacity: 0;
        }

        36%,
        94% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes fly {

        0%,
        36% {
            left: 0;
            opacity: 0;
            transform: scale(.5);
        }

        40% {
            opacity: 1;
            transform: scale(1);
        }

        54% {
            left: calc(100% - 52px);
            opacity: 1;
            transform: scale(1);
        }

        58%,
        100% {
            left: calc(100% - 52px);
            opacity: 0;
            transform: scale(.5);
        }
    }

    @keyframes grow {

        0%,
        55% {
            grid-template-rows: 0fr;
            opacity: 0;
        }

        62%,
        94% {
            grid-template-rows: 1fr;
            opacity: 1;
        }

        100% {
            grid-template-rows: 0fr;
            opacity: 0;
        }
    }

    @keyframes count {

        0%,
        57% {
            content: "2";
        }

        58%,
        97% {
            content: "3";
        }
    }

    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }

        .reveal,
        .b,
        .link__fly,
        .traveler__won {
            opacity: 1;
            transform: none;
        }

        .newdeal {
            grid-template-rows: 1fr;
        }

        .send__a {
            opacity: 0;
        }

        .send__b {
            opacity: 1;
        }

        .traveler {
            transform: translateX(300%);
        }

        .traveler__bar i {
            transform: none;
        }
    }

    /* Responsivo */
    @media (max-width: 960px) {
        .hero {
            padding-top: 120px;
        }

        .hero__top,
        .steps__grid {
            grid-template-columns: 1fr;
            gap: 48px;
        }

        .form-card {
            transform: none;
        }

        .sync__stage {
            grid-template-columns: 1fr;
            max-width: 520px;
            margin-inline: auto;
        }

        .link {
            height: 80px;
        }

        .link__line {
            width: 3px;
            height: 100%;
            background: repeating-linear-gradient(180deg, rgba(85, 176, 255, .8) 0 10px, transparent 10px 18px);
        }

        .link__fly {
            left: 50%;
            margin-left: -26px;
            animation: none;
            opacity: 1;
        }
    }

    @media (max-width: 560px) {
        .hero {
            padding: 110px 0 64px;
        }

        .hl {
            white-space: normal;
        }

        .lead {
            font-size: 18px;
        }

        .steps,
        .sync {
            padding: 80px 0;
        }

        .form-card {
            padding: 24px 20px;
        }

        .lead-form__row {
            grid-template-columns: 1fr;
        }

        .board {
            margin-top: 48px;
            padding: 10px;
        }

        .todo {
            padding: 20px 16px;
        }

        .todo__head {
            flex-direction: column;
            align-items: flex-start;
        }

        .opp__step {
            flex-wrap: wrap;
        }
    }

    .form-group {
        margin-bottom: 10px;
        gap: 2px;
    }

    .submit {
        width: 100%;
    }

    .form-group-checkbox input {
        width: unset;
    }

    .form-group-checkbox {
        text-align: left;
        position: relative;
        line-height: 1;
        margin-bottom: 2rem;
    }

    .iti {
        width: 100%;
    }
</style>

<header class="topbar">
    <div class="container topbar__inner">
        <img decoding="async" src="{{ asset('storage/site/lp/digify-logo-fundo-escuro.svg') }}" alt="Digify"
            class="topbar__logo" width="120" height="40">
        <a href="#formulario-de-contato" class="btn btn--sm">Quero conhecer</a>
    </div>
</header>

<!-- DOBRA 1 — o funil em movimento -->
<section class="hero">
    <div class="hero__bg" aria-hidden="true"></div>

    <div class="container hero__top">
        <div class="hero__copy">
            <span class="kicker">CRM DIGIFY</span>
            <h1>Organize suas vendas do <em class="hl hl--start">primeiro contato</em> ao&nbsp;<em
                    class="hl hl--end">fechamento</em>.</h1>
            <p class="lead">Acompanhe leads, oportunidades e próximos passos em um CRM simples para a
                rotina&nbsp;comercial.</p>
        </div>

        <div class="form-card" id="formulario-de-contato">
            <div class="form-card__head">
                <span class="form-card__pill">Novo lead</span>
                <h2>Comece seu funil por&nbsp;aqui</h2>
            </div>



            @php
                $formHubSpot = getFormHubSpotById(4);
            @endphp
            @if (!empty($formHubSpot))
                <div id="step-content" class="lead-form">
                    @include('forms.form-custom-hubspot', ['formHubSpot' => $formHubSpot])
                </div>
            @endif


            <div id="step-success" class="form-success hidden" role="status" aria-live="polite">
                <strong>Você entrou no nosso funil! 🎯</strong>
                <span>Em breve nosso time fala com você.</span>
            </div>

        </div>
    </div>

    <!-- Quadro de vendas animado -->
    <div class="container">
        <div class="board" aria-label="Exemplo de funil de vendas">
            <div class="board__scroll">
                <div class="board__lanes">
                    <div class="lane" style="--c:#55B0FF">
                        <header><i class="lane__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M19 8v6M22 11h-6" />
                                </svg></i><b>Primeiro contato</b><span>3</span></header>
                        <div class="deal"><strong>Loja do Futuro</strong><small>R$&nbsp;5.400</small></div>
                        <div class="deal deal--ghost"><strong>Norte Consultoria</strong><small>R$&nbsp;1.800</small>
                        </div>
                    </div>
                    <div class="lane" style="--c:#0A50FF">
                        <header><i class="lane__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg></i><b>Qualificação</b><span>2</span></header>
                        <div class="deal"><strong>TechStart</strong><small>R$&nbsp;3.200</small></div>
                    </div>
                    <div class="lane" style="--c:#FFB21A">
                        <header><i class="lane__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6M16 13H8M16 17H8" />
                                </svg></i><b>Proposta</b><span>2</span></header>
                        <div class="deal"><strong>Dados Inteligentes</strong><small>R$&nbsp;12.700</small></div>
                        <div class="deal deal--ghost"><strong>HelpTech</strong><small>R$&nbsp;6.300</small></div>
                    </div>
                    <div class="lane" style="--c:#18C7A8">
                        <header><i class="lane__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6M18 9h1.5a2.5 2.5 0 0 0 0-5H18M4 22h16M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22M18 2H6v7a6 6 0 0 0 12 0V2z" />
                                </svg></i><b>Fechamento</b><span>1</span></header>
                        <div class="deal"><strong>Cloud Elevate</strong><small>R$&nbsp;6.900</small></div>
                    </div>

                    <div class="traveler" aria-hidden="true">
                        <div class="traveler__card">
                            <div class="traveler__top"><strong>Sua empresa</strong><span class="traveler__won">Ganho
                                    ✓</span></div>
                            <small>Próximo passo em&nbsp;dia</small>
                            <div class="traveler__bar"><i></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DOBRA 2 — próximos passos interativos -->
<section class="steps lazy-section">
    <div class="container steps__grid">
        <div class="steps__copy reveal">
            <span class="kicker kicker--blue">Rotina comercial</span>
            <h2>Cada oportunidade com um <span class="grad">próximo&nbsp;passo</span></h2>
            <p>Centralize leads e contatos, acompanhe negociações em um funil visual e organize tarefas, reuniões e
                follow-ups em um só lugar. Assim, a equipe sabe o que precisa de atenção e a gestão acompanha o
                andamento das&nbsp;vendas.</p>
            <ul class="ticks">
                <li><span style="--c:#0A50FF"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg></span>Leads e contatos&nbsp;centralizados</li>
                <li><span style="--c:#18C7A8"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <path d="M8 7v7M12 7v4M16 7v9" />
                        </svg></span>Negociações em um funil&nbsp;visual</li>
                <li><span style="--c:#FFB21A"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18M9 16l2 2 4-4" />
                        </svg></span>Tarefas, reuniões e&nbsp;follow-ups</li>
            </ul>
        </div>

        <div class="todo reveal">
            <div class="todo__head">
                <div>
                    <small>Agenda do&nbsp;time</small>
                    <strong>Próximos passos de hoje</strong>
                </div>
                <div class="todo__score"><b id="done">0</b>/4 ganhos</div>
            </div>
            <p class="todo__hint">👆 Clique em “Feito” e veja a oportunidade&nbsp;avançar</p>

            <div class="opp"
                data-steps="Ligar para apresentar a Digify|Agendar reunião de diagnóstico|Enviar proposta|Negócio ganho!">
                <div class="opp__meta"><img decoding="async" class="opp__owner"
                        src="{{ asset('storage/site/lp/headshot-03.webp') }}" alt=""
                        title="Vendedor responsável"><strong>Loja do Futuro</strong><span>R$ 5.400</span></div>
                <div class="opp__step"><span class="opp__icon"><svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg></span>
                    <p>Ligar para apresentar a&nbsp;Digify</p><button type="button">Feito</button>
                </div>
                <div class="opp__bar"><i></i></div>
            </div>
            <div class="opp"
                data-steps="Reunião às 10h|Enviar proposta revisada|Follow-up de aprovação|Negócio ganho!">
                <div class="opp__meta"><img decoding="async" class="opp__owner"
                        src="{{ asset('storage/site/lp/headshot-01.webp') }}" alt=""
                        title="Vendedor responsável"><strong>TechStart</strong><span>R$ 3.200</span></div>
                <div class="opp__step"><span class="opp__icon"><svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg></span>
                    <p>Reunião às&nbsp;10h</p><button type="button">Feito</button>
                </div>
                <div class="opp__bar"><i></i></div>
            </div>
            <div class="opp" data-steps="Follow-up da proposta|Ajustar condições|Negócio ganho!">
                <div class="opp__meta"><img decoding="async" class="opp__owner"
                        src="{{ asset('storage/site/lp/headshot-06.webp') }}" alt=""
                        title="Vendedor responsável"><strong>Dados Inteligentes</strong><span>R$ 12.700</span></div>
                <div class="opp__step"><span class="opp__icon"><svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 0 1 15-6.7L21 8" />
                            <path d="M21 3v5h-5" />
                            <path d="M21 12a9 9 0 0 1-15 6.7L3 16" />
                            <path d="M8 16H3v5" />
                        </svg></span>
                    <p>Follow-up da&nbsp;proposta</p><button type="button">Feito</button>
                </div>
                <div class="opp__bar"><i></i></div>
            </div>
            <div class="opp" data-steps="Enviar contrato|Negócio ganho!">
                <div class="opp__meta"><img decoding="async" class="opp__owner"
                        src="{{ asset('storage/site/lp/headshot-08.webp') }}" alt=""
                        title="Vendedor responsável"><strong>Cloud Elevate</strong><span>R$ 6.900</span></div>
                <div class="opp__step"><span class="opp__icon"><svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <path d="M14 2v6h6M16 13H8M16 17H8" />
                        </svg></span>
                    <p>Enviar&nbsp;contrato</p><button type="button">Feito</button>
                </div>
                <div class="opp__bar"><i></i></div>
            </div>
        </div>
    </div>
</section>

<!-- DOBRA 3 — Digisac + Digify -->
<section class="sync lazy-section">
    <div class="container">
        <div class="sync__head reveal">
            <span class="kicker kicker--light">Integração</span>
            <h2>Atendimento e vendas&nbsp;<span class="grad grad--light">conectados</span></h2>
            <p>Com a integração entre Digisac e Digify, os contatos e as conversas iniciados no atendimento podem
                acompanhar a jornada comercial no CRM, ajudando sua equipe a dar continuidade às oportunidades com
                mais&nbsp;contexto.</p>
        </div>

        <div class="sync__stage reveal" aria-hidden="true">
            <!-- Digisac: conversa no WhatsApp -->
            <div class="app app--sac">
                <div class="app__bar app__bar--sac"><img decoding="async"
                        src="{{ asset('storage/site/lp/digisac-branco.svg') }}"
                        alt="Digisac"><span>Atendimento</span></div>
                <div class="wa-contact"><img decoding="async" src="{{ asset('storage/site/lp/headshot-04.webp') }}"
                        alt="">
                    <div><b>Livia Gomes</b><small><img decoding="async"
                                src="{{ asset('storage/site/lp/WhatsApp.svg') }}" alt="">WhatsApp
                            ·&nbsp;online</small></div>
                </div>
                <div class="app__chat">
                    <div class="b b--in b1">Olá! Quero entender os planos para minha equipe.<span
                            class="tm">10:02</span></div>
                    <div class="b b--out b2">Claro, Livia! Quantas pessoas atendem hoje?<span class="tm">10:03
                            <svg class="tick" viewBox="0 0 16 16">
                                <path
                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                            </svg></span></div>
                    <div class="b b--in b3">Somos 12 no comercial.<span class="tm">10:03</span></div>
                </div>
                <div class="app__action">
                    <span class="send"><img decoding="async"
                            src="{{ asset('storage/site/lp/digify-icone-mono-branco.svg') }}" alt=""><span
                            class="send__label"><span class="send__a">Enviar para a
                                Digify</span><span class="send__b">Enviado ao CRM ✓</span></span></span>
                </div>
            </div>

            <!-- ligação -->
            <div class="link">
                <span class="link__line"></span>
                <span class="link__fly"><img decoding="async" src="{{ asset('storage/site/lp/headshot-04.webp') }}"
                        alt=""></span>
            </div>

            <!-- Digify: entra no funil -->
            <div class="app app--fy">
                <div class="app__bar app__bar--fy"><img decoding="async"
                        src="{{ asset('storage/site/lp/digify-logo-fundo-escuro.svg') }}" alt="Digify"><span>Funil
                        ·
                        Comercial</span></div>
                <div class="col">
                    <header class="col__head">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M19 8v6M22 11h-6" />
                        </svg>
                        <b>Primeiro contato</b><span class="col__count"></span>
                    </header>
                    <div class="newdeal">
                        <div class="newdeal__inner">
                            <div class="newdeal__card">
                                <div class="newdeal__top">
                                    <img decoding="async" src="{{ asset('storage/site/lp/headshot-04.webp') }}"
                                        alt="">
                                    <div><small>Novo&nbsp;negócio</small><strong>Livia Gomes</strong></div>
                                    <img decoding="async" class="newdeal__owner"
                                        src="{{ asset('storage/site/lp/headshot-03.webp') }}" alt=""
                                        title="Vendedor responsável">
                                </div>
                                <div class="newdeal__tags">
                                    <span class="tg tg--wa"><img decoding="async"
                                            src="{{ asset('storage/site/lp/WhatsApp.svg') }}" alt="">Origem:
                                        Digisac</span>
                                    <span class="tg"><svg viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                        </svg>3 mensagens no histórico</span>
                                </div>
                                <div class="newdeal__next"><span>Próximo passo</span><b>Enviar proposta</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="olddeal"><strong>Loja do Futuro</strong><small>R$&nbsp;5.400</small></div>
                    <div class="olddeal olddeal--ghost"><strong>Norte Consultoria</strong><small>R$&nbsp;1.800</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="sync__cta reveal">
            <a href="#formulario-de-contato" class="btn btn--light">CONHECER A DIGIFY <span
                    aria-hidden="true">→</span></a>
        </div>
    </div>
</section>

<script>
    // Desempenho: pausa as animações das seções que não estão na tela
    const visible = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            e.target.classList.toggle('is-paused', !e.isIntersecting);
            e.target.querySelectorAll('svg').forEach((s) => s.pauseAnimations && (e.isIntersecting ? s
                .unpauseAnimations() : s.pauseAnimations()));
        });
    }, {
        rootMargin: '100px'
    });
    document.querySelectorAll('section').forEach((s) => visible.observe(s));

    // Animação de entrada
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('is-in');
                io.unobserve(e.target);
            }
        });
    }, {
        threshold: 0.15
    });
    document.querySelectorAll('.reveal').forEach((el) => io.observe(el));

    // Próximos passos interativos
    const trophy =
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6M18 9h1.5a2.5 2.5 0 0 0 0-5H18M4 22h16M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22M18 2H6v7a6 6 0 0 0 12 0V2z"/></svg>';
    let done = 0;
    document.querySelectorAll('.opp').forEach((opp) => {
        const steps = opp.dataset.steps.split('|');
        let i = 0;
        const text = opp.querySelector('.opp__step p');
        const bar = opp.querySelector('.opp__bar i');
        const btn = opp.querySelector('button');
        const update = () => {
            bar.style.width = (i / (steps.length - 1)) * 100 + '%';
        };
        update();
        btn.addEventListener('click', () => {
            if (i >= steps.length - 1) return;
            i++;
            opp.classList.remove('is-tick');
            void opp.offsetWidth;
            opp.classList.add('is-tick');
            text.textContent = steps[i];
            update();
            if (i === steps.length - 1) {
                opp.classList.add('is-won');
                opp.querySelector('.opp__icon').innerHTML = trophy;
                btn.textContent = 'Ganho';
                btn.disabled = true;
                document.getElementById('done').textContent = ++done;
            }
        });
    });
</script>
