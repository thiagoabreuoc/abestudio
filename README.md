# AB Estúdio

Site institucional do AB Estúdio — estúdio criativo de design e desenvolvimento digital. Portfólio de projetos, serviços e páginas institucionais.

## Stack

- WordPress (core completo neste repositório)
- Tema próprio em [`wp-content/themes/abestudio`](wp-content/themes/abestudio)
- Custom Post Type **Portfólio** (`portfolio`) com taxonomia **Categoria de Projeto** (`categoria_portfolio`)
- Banco de dados **SQLite** via [SQLite Database Integration](wp-content/plugins/sqlite-database-integration) (drop-in `wp-content/db.php`) — sem necessidade de MySQL para rodar localmente

## Rodando localmente

1. Copie `wp-config-sample.php` para `wp-config.php` e ajuste `WP_HOME`/`WP_SITEURL` para a porta que for usar.
2. Suba o servidor embutido do PHP a partir da raiz do projeto:

   ```
   php -S localhost:8001
   ```

3. Acesse `http://localhost:8001/` — se ainda não houver instalação, o WordPress guia pelo instalador (`wp-admin/install.php`).
4. Em **Aparência > Temas**, ative o tema **AB Estúdio**.
5. Em **Configurações > Links Permanentes**, use uma estrutura com prefixo `/index.php/` (ex.: `/index.php/%postname%/`) — o servidor embutido do PHP não tem mod_rewrite, e esse prefixo permite permalinks legíveis mesmo assim.

## Estrutura de conteúdo

- **Portfólio** — CPT `portfolio`, com imagem destacada, resumo e categorias (`categoria_portfolio`). Aparece na home (últimos 6 projetos) e no arquivo `/portfolio/`.
- **Serviços** — seção estática em [`front-page.php`](wp-content/themes/abestudio/front-page.php), editável direto no código (array `$abe_services`).
- **Páginas** — Sobre e Contato como páginas comuns do WordPress, editáveis pelo admin.
