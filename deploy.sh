ssh root@194.59.140.121 "cd /var/www/html/nuxt-pwa-test/; git checkout main; git pull;"
npm run generate;
scp -P22 -pr ./dist/* root@194.59.140.121:/var/www/html/;