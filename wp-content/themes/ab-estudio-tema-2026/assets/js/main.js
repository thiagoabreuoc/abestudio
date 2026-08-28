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

	// Acima de 769px o botão começa fixo (posição vinda do CSS: 50px
	// abaixo do fim do hero-banner), mas não pode descer, em coordenadas
	// do documento, além da metade da altura total da página — depois
	// desse ponto ele "descola" da tela e passa a rolar normal com o
	// conteúdo, ficando pra trás. "Metade da página" muda com o
	// conteúdo, então não dá pra fixar isso só em CSS.
	var mq = window.matchMedia( '(min-width: 769px)' );
	var baseTop = null;

	function captureBaseTop() {
		wrap.style.position = '';
		wrap.style.top = '';
		baseTop = parseFloat( window.getComputedStyle( wrap ).top );
	}

	function update() {
		if ( ! mq.matches ) {
			wrap.style.position = '';
			wrap.style.top = '';
			baseTop = null;
			return;
		}

		if ( null === baseTop ) {
			captureBaseTop();
		}

		var halfPage = document.documentElement.scrollHeight / 2;
		var docPosition = window.scrollY + baseTop;

		if ( docPosition > halfPage ) {
			wrap.style.position = 'absolute';
			wrap.style.top = halfPage + 'px';
		} else {
			wrap.style.position = 'fixed';
			wrap.style.top = baseTop + 'px';
		}
	}

	window.addEventListener( 'scroll', update, { passive: true } );
	window.addEventListener( 'resize', function () {
		baseTop = null;
		update();
	} );

	if ( mq.addEventListener ) {
		mq.addEventListener( 'change', function () {
			baseTop = null;
			update();
		} );
	}

	update();
} );
