import { defineConfig } from 'vite';
import { createHtmlPlugin } from 'vite-plugin-html';
import path from 'path';

export default defineConfig({
  plugins: [
    createHtmlPlugin({
      inject: {
        data: {
          title: 'Vitrine de Motos',
        },
      },
    }),
  ],

  root: './frontend', // Define a raiz do projeto de frontend

  build: {
    outDir: '../public/assets', // Saída ajustada para gerar assets dentro de "public/assets"
    rollupOptions: {
      output: {
        assetFileNames: ({ name }) => {
          if (/\.(gif|jpe?g|png|svg|ico|webp|avif)$/.test(name || '')) {
            return 'images/[name]-[hash][extname]'; // Caminho ajustado para imagens
          }
          if (/\.(css)$/.test(name || '')) {
            return 'styles/[name]-[hash][extname]'; // Caminho ajustado para CSS
          }
          if (/\.(ttf|otf|woff|woff2)$/.test(name || '')) {
            return 'fonts/[name]-[hash][extname]'; // Caminho ajustado para fontes
          }
          return '[name]-[hash][extname]'; // Padrão para outros arquivos
        },
        chunkFileNames: 'chunks/[name]-[hash].js', // Arquivos divididos
        entryFileNames: 'scripts/[name]-[hash].js', // Arquivo de entrada JS
      },
    },
  },

  resolve: {
    alias: {
      '@assets-images': path.resolve(__dirname, 'public/assets-images'),
      '@assets-icons': path.resolve(__dirname, 'public/assets-icons'),
      '@scripts': path.resolve(__dirname, 'frontend/scripts'),
      '@styles': path.resolve(__dirname, 'frontend/styles'),
      '@pages': path.resolve(__dirname, 'frontend/pages'),
      '@layouts': path.resolve(__dirname, 'frontend/layouts'),
    },
  },

  server: {
    open: true,
    port: 3000,
    proxy: {
      // Redireciona requisições para o backend PHP no XAMPP
      '/api': 'http://localhost:8000', // Endpoint para APIs
      '/': {
        target: 'http://localhost/projeto-vitrine-motos/public', // Backend PHP
        changeOrigin: true,
        secure: false,
      },
    },
  },

  preview: {
    port: 4173, // Porta usada para pré-visualização da build
  },
});
