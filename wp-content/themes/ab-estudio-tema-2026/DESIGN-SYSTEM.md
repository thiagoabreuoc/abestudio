# AB Estúdio — Design System

Registro da paleta de cores do tema como fonte única de verdade. Os nomes das variáveis CSS (`--abe-*`) são históricos (datam da primeira versão do tema) e não descrevem mais o tom literal — use este documento como mapa entre nome e cor real.

> Nota: o tema passou por algumas experiências de paleta ("Bamboo Lemon UI", "Electric Tennis Court") que foram revertidas a pedido. A tabela abaixo reflete a paleta **atual/definitiva** em produção.

## Paleta de cores

| Swatch | Hex | Variável CSS | Papel |
|---|---|---|---|
| 🟢 | `#1AC18A` | `--abe-teal` | Teal — âncora inicial (0%) do degradê do banner e do logo mascarado do menu; cor de hover dos itens de menu. |
| 🟢 | `#25D3A0` | `--abe-green` | Verde — parada intermediária do degradê, cor da bolha 1 (`blob1`). |
| 🟡 | `#EEC154` | `--abe-yellow` | Amarelo — parada alta do degradê, cor da bolha 2 (`blob2`). |
| 🟠 | `#E2B557` | `--abe-orange` | Laranja — parada final (100%) do degradê. |
| ⬜ | `#FFFFFF` | `--abe-bg` | Branco. Superfície padrão (fundo do site fora do banner). |
| ⬛ | `#232323` | `--abe-ink` | Texto e elementos de UI (títulos, botão, hambúrguer, ícone do WhatsApp, travessão). Neutro escuro, independente do degradê — sempre legível em qualquer ponto da animação. |

Todas definidas em `:root` no topo de `style.css`.

## Clima e uso

**Clima:** vibrante, tech, acolhedor — degradê animado teal → verde → amarelo → laranja como assinatura visual do hero.

**Diretrizes:**
- Deixe a maior parte das superfícies **fora do banner** em branco (`--abe-bg`) — cards, seções de conteúdo, formulários.
- Use `--abe-ink` para todo texto de leitura e ícones de UI; é intencionalmente um neutro (não uma cor do degradê), para nunca perder contraste conforme a animação do banner muda de tom por trás.
- O degradê do banner (`--abe-teal → --abe-green → --abe-yellow → --abe-orange`) é a única área da UI com uso pesado de cor saturada; o resto do site deve ficar neutro (branco + ink) para não competir com ele.

## Onde a paleta é usada hoje (`style.css`)

- `.hero-banner` — degradê animado principal (`linear-gradient` + 2 `radial-gradient` de "bolhas"), ciclando ângulo e posições via `@keyframes abe-gradient-drift`.
- `.nav-drawer-header .site-logo-mark` — o logo "ab" com máscara de gradiente, mesma sequência de cores do banner.
- `.hero-title-solid`, `.hero-copy .button`, `.hamburger span`, `.header-whatsapp`, `.header-whatsapp-icon`, `.hero-quote`, `.hero-quote .dash` — todos usam `--abe-ink`.
- `.nav-drawer .primary-menu a:hover` — usa `--abe-teal` como cor de destaque no hover.

## Tipografia

- **Heading/Body:** Poppins (400, 500, 600, 700), via Google Fonts.
- Títulos usam peso 800 (`.hero-title span`) — carregado pelo `font-weight` da declaração, não pelo enqueue (vale conferir se o peso 800 está de fato disponível; hoje só 400–700 são carregados em `functions.php`).

## Outros tokens

- `--abe-max-width: 1200px` — definida mas hoje não aplicada a `.container` (usa `width:100%` + padding fixo). Candidata a uso futuro se o layout precisar de um teto de largura central.
