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

	// Acima de 500px o botão nasce fixo 30px abaixo do hero-banner e sobe
	// até parar fixo no meio da tela conforme a página rola, acompanhando
	// o scroll em tempo real (sem "salto" animado por CSS) — mesma lógica
	// nas duas faixas (501-768px e 769px+) agora.
	var mq = window.matchMedia( '(min-width: 501px)' );
	var BANNER_GAP = 30;
	var TRANSITION_DISTANCE = 300; // px de scroll até chegar no meio da tela
	var banner = document.querySelector( '.hero-banner' );
	var ticking = false;

	// offsetTop/offsetHeight (não getBoundingClientRect) porque precisa
	// da posição do banner em coordenadas do DOCUMENTO, fixa, indepen-
	// dente do scroll atual — getBoundingClientRect muda a cada scroll,
	// o que faria o "ponto de partida" se mover junto com o progresso,
	// bagunçando a interpolação.
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
		var endTop = ( viewportHeight - height ) / 2;
		var progress = Math.min( window.scrollY / TRANSITION_DISTANCE, 1 );

		wrap.style.bottom = 'auto';
		wrap.style.top = ( startTop + ( endTop - startTop ) * progress ) + 'px';
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
