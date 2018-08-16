namespace :php do
    desc 'Charge les dependances de composer'
    task :composer do
        on roles(:web) do
            within release_path do
                execute :composer, :install, "--optimize-autoloader"
            end
        end
    end
end