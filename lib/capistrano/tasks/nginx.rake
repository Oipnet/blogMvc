namespace :nginx do
    desc 'Cration du fichier de conf nginx'
    task :conf do
        on roles(:web) do
            erb = File.read "lib/capistrano/templates/nginx_conf.erb"
            set :server_name, ask("Nom de domaine", "blogmvc.oipnet.info")
            set :config_name, ask("Nom du fichier de configuration", "blogmvc.oipnet.info.conf")
            config_file = "/tmp/nginx_#{fetch(:config_name)}"
            upload! StringIO.new(ERB.new(erb).result(binding)), config_file
            sudo :mv, config_file, "/etc/nginx/sites-available/#{fetch(:config_name)}"
            sudo :ln, "-fs", "/etc/nginx/sites-available/#{fetch(:config_name)}",  "/etc/nginx/sites-enabled/#{fetch(:config_name)}"
            sudo :service, :nginx, :restart
        end
    end
end