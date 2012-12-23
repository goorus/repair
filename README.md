# download vendor packages
composer install

# create database structure
php app/console doctrine:migrations:migrate

# init base page's routers (you can change "all" to your site id)
php app/console sonata:page:create-site
php app/console sonata:page:update-core-routes --site=all
php app/console sonata:page:create-snapshots --site=all
# it's may be necessary to update assets
php app/console assets:install
