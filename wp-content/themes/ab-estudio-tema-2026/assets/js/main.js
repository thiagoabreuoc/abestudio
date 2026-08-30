document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.querySelector( '[data-nav-toggle]' );
	var drawer = document.querySelector( '[data-nav-drawer]' );
	var overlay = document.querySelector( '[data-nav-overlay]' );
	var closeBtn = document.querySelector( '[data-nav-close]' );

	if ( ! toggle || ! drawer ) {
		return;
	}

	function openDrawer() {
		drawer.classList.add( 'is-open' );
		if ( overlay ) {
			overlay.classList.add( 'is-open' );
		}
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	}

	function closeDrawer() {
		drawer.classList.remove( 'is-open' );
		if ( overlay ) {
			overlay.classList.remove( 'is-open' );
		}
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = drawer.classList.contains( 'is-open' );
		if ( isOpen ) {
			closeDrawer();
		} else {
			openDrawer();
		}
	} );

	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', closeDrawer );
	}

	if ( overlay ) {
		overlay.addEventListener( 'click', closeDrawer );
	}

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key ) {
			closeDrawer();
		}
	} );
} );

document.addEventListener( 'DOMContentLoaded', function () {
	var quoteText = document.querySelector( '.hero-quote-text' );

	if ( ! quoteText || ! quoteText.dataset.phrases ) {
		return;
	}

	var phrases = quoteText.dataset.phrases.split( '|' );
	var phraseIndex = 0;

	var WORD_DELAY = 220;
	var HOLD_TIME = 5000;
	var FADE_OUT_TIME = 350;

	function showPhrase() {
		var words = phrases[ phraseIndex ].split( ' ' );

		quoteText.innerHTML = '';

		var wordEls = words.map( function ( word ) {
			var span = document.createElement( 'span' );
			span.className = 'hero-quote-word';
			span.textContent = word;
			quoteText.appendChild( span );
			quoteText.appendChild( document.createTextNode( ' ' ) );
			return span;
		} );

		wordEls.forEach( function ( span, i ) {
			setTimeout( function () {
				span.classList.add( 'is-visible' );
			}, i * WORD_DELAY );
		} );

		var revealDuration = ( wordEls.length - 1 ) * WORD_DELAY + 500;

		setTimeout( function () {
			wordEls.forEach( function ( span ) {
				span.classList.remove( 'is-visible' );
				span.classList.add( 'is-hiding' );
			} );

			setTimeout( function () {
				phraseIndex = ( phraseIndex + 1 ) % phrases.length;
				showPhrase();
			}, FADE_OUT_TIME );
		}, revealDuration + HOLD_TIME );
	}

	showPhrase();
} );

document.addEventListener( 'DOMContentLoaded', function () {
	var wrap = document.querySelector( '.whatsapp-wrap' );

	if ( ! wrap ) {
		return;
	}

	// Acima de 500px o botão nasce fixo 30px abaixo do hero-banner e
	// acompanha o scroll 1:1 (mesma taxa da página, sem lag/adiantamento
	// — por isso não "descola" do banner), até no máximo parar fixo no
	// meio vertical da tela. Mesma lógica nas duas faixas (501-768px e
	// 769px+).
	var mq = window.matchMedia( '(min-width: 501px)' );
	var BANNER_GAP = 30;
	var banner = document.querySelector( '.hero-banner' );
	var ticking = false;

	// offsetTop/offsetHeight (não getBoundingClientRect) porque precisa
	// da posição do banner em coordenadas do DOCUMENTO, fixa, indepen-
	// dente do scroll atual — getBoundingClientRect muda a cada scroll,
	// o que faria o "ponto de partida" se mover junto com o progresso,
	// bagunçando o cálculo.
	function bannerBottomInDocument() {
		return banner.offsetTop + banner.offsetHeight;
	}

	function render() {
		ticking = false;

		if ( ! mq.matches || ! banner ) {
			wrap.style.top = '';
			wrap.style.bottom = '';
			return;
		}

		var height = wrap.offsetHeight;
		var viewportHeight = window.innerHeight;
		var startTop = bannerBottomInDocument() + BANNER_GAP;
		var centerTop = ( viewportHeight - height ) / 2;
		// Math.max(0, ...): alguns navegadores/touchpads reportam scrollY
		// momentaneamente negativo durante o "elástico" nativo de rebote
		// ao passar do topo da página. Sem o clamp, esse valor negativo
		// empurrava o botão pra baixo da posição de descanso por um
		// instante, até o rebote assentar e ele voltar ao lugar.
		var scrollY = Math.max( 0, window.scrollY );

		wrap.style.bottom = 'auto';
		wrap.style.top = Math.max( centerTop, startTop - scrollY ) + 'px';
	}

	function requestRender() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( render );
		}
	}

	window.addEventListener( 'scroll', requestRender, { passive: true } );
	window.addEventListener( 'resize', requestRender );
	render();
} );

document.addEventListener( 'DOMContentLoaded', function () {
	var header = document.querySelector( '.site-header' );

	if ( ! header ) {
		return;
	}

	// Header vira sólido (branco, ver CSS .is-scrolled) assim que a
	// página começa a rolar, em qualquer largura.
	var SCROLL_THRESHOLD = 10;

	function update() {
		if ( window.scrollY > SCROLL_THRESHOLD ) {
			header.classList.add( 'is-scrolled' );
		} else {
			header.classList.remove( 'is-scrolled' );
		}
	}

	window.addEventListener( 'scroll', update, { passive: true } );
	window.addEventListener( 'resize', update );
	update();
} );

document.addEventListener( 'DOMContentLoaded', function () {
	// Cada [data-section-nav] é um cluster independente (rótulo +
	// botões de navegação), ligado à sessão referenciada por
	// data-section-target (o id dela) — sem estado compartilhado entre
	// clusters, então um nunca pode "vazar" pro estado do outro.
	var items = Array.prototype.slice.call( document.querySelectorAll( '[data-section-nav]' ) )
		.map( function ( nav ) {
			var section = document.getElementById( nav.dataset.sectionTarget );
			var badge = nav.querySelector( '.section-badge' );
			if ( section && badge ) {
				badge.textContent = section.dataset.sectionName || '';
			}
			return { nav: nav, section: section };
		} )
		.filter( function ( item ) {
			return !! item.section;
		} );

	if ( ! items.length ) {
		return;
	}

	// Botões de navegação: rolam suavemente até a sessão anterior/
	// próxima (referenciada pelo id em data-scroll-to).
	Array.prototype.forEach.call( document.querySelectorAll( '[data-scroll-to]' ), function ( btn ) {
		btn.addEventListener( 'click', function () {
			var target = document.getElementById( btn.dataset.scrollTo );
			if ( target ) {
				target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			}
		} );
	} );

	// Só abaixo de 769px (mobile + tablet). Cada rótulo aparece só enquanto a SUA sessão
	// está "no topo" no momento — topo já passado (rect.top <= 0) mas
	// fundo ainda não (rect.bottom > 0), ou seja, a sessão que você está
	// atravessando agora. Checagem de contenção simples a cada frame:
	// como não depende de "pegar" o instante exato do cruzamento (só de
	// saber, a cada frame, onde você está), não tem como uma rolagem
	// rápida pular a detecção.
	var mq = window.matchMedia( '(max-width: 768px)' );
	var ticking = false;
	var lastItem = items[ items.length - 1 ];

	function render() {
		ticking = false;

		// Exceção pra ÚLTIMA sessão da página: se ela for curta (menor
		// que a viewport) e não sobrar conteúdo depois dela, o topo dela
		// nunca chega a cruzar rect.top<=0 — o scroll trava no fim do
		// documento antes disso (ex.: viewport 700px, mas o topo da
		// sessão só sobe até 142px). Sem essa exceção, o rótulo dela
		// nunca apareceria. No fim da página, ela conta como "no topo"
		// mesmo com rect.top positivo.
		var atBottom = ( window.scrollY + window.innerHeight ) >= ( document.documentElement.scrollHeight - 1 );

		// Tolerância pequena em vez de exigir rect.top<=0 exato: o
		// negative-margin do hero-banner é calibrado pra terminar bem
		// perto de 0 debaixo do header sticky, mas qualquer diferença de
		// altura do header (linha de botões quebrando, fonte carregando)
		// desloca isso alguns pixels — sem essa margem, um section-nav
		// podia nunca "ativar" por ficar sempre 5-10px positivo.
		var TOP_TOLERANCE = 20;

		// Duas sessões podem ficar "ativas" ao mesmo tempo perto da
		// transição (ou pela exceção do fim de página acima) — só a
		// última em ordem de documento fica visível, as outras somem.
		var activeItem = null;

		items.forEach( function ( item ) {
			var rect = item.section.getBoundingClientRect();
			var reachedTop = rect.top <= TOP_TOLERANCE || ( atBottom && item === lastItem );
			if ( mq.matches && reachedTop && rect.bottom > 0 ) {
				activeItem = item;
			}
		} );

		items.forEach( function ( item ) {
			item.nav.classList.toggle( 'is-visible', item === activeItem );
		} );
	}

	function requestRender() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( render );
		}
	}

	window.addEventListener( 'scroll', requestRender, { passive: true } );
	window.addEventListener( 'resize', requestRender );
	render();
} );
