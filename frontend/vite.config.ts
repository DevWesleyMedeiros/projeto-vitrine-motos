import { defineConfig } from 'vite';
import { resolve } from 'path';
import { createHtmlPlugin } from 'vite-plugin-html';
import eslintPlugin from 'vite-plugin-eslint';
import path from 'path'

export default defineConfig({
    plugins: [
        createHtmlPlugin({
          inject: {
            data: {
              title: 'Vitrine de Motos',
            },
          },
        }),
        eslintPlugin(),
      ],

  root: './frontend',

  build: {
    // Saída do build na pasta "public", onde será integrado com o backend PHP
    outDir: '../public',
    rollupOptions: {
      output: {
        assetFileNames: ({ name }) => {
          if (/\.(gif|jpe?g|png|svg|ico|webp|avif)$/.test(name || '')) {
            return 'assets/images/[name]-[hash][extname]';
          }
          if (/\.(css)$/.test(name || '')) {
            return 'assets/styles/[name]-[hash][extname]';
          }
          if (/\.(ttf|otf|woff|woff2)$/.test(name || '')) {
            return 'assets/fonts/[name]-[hash][extname]';
          }
          return 'assets/[name]-[hash][extname]';
        },
        chunkFileNames: 'chunks/[name]-[hash].js',
        entryFileNames: 'scripts/[name]-[hash].js',
      },
    },
  },

  resolve: {
    alias: {
      '@assets': path.resolve(__dirname, 'frontend/assets'),
      '@scripts': path.resolve(__dirname, 'frontend/scripts'),
      '@styles': path.resolve(__dirname, 'frontend/styles'),
      '@pages': path.resolve(__dirname, 'frontend/pages'),
      '@layouts':path.resolve(__dirname, 'frontend/layouts')
    },
  },

  server: {
    open: true,
    port: 3000,
    proxy: {
      '/api': 'http://localhost:8000',
    },
  },
  preview: {
    port: 4173,
  },
});
