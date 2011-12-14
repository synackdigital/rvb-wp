guard 'shell' do
  watch(%r{src/.*\.js}) do |file|
    'growlnotify -m "#{file} changed, running sprockets"'
    'bundle exec rake'
  end
end

guard 'compass' do
  watch(%r{sass/(.*)\.s[ac]ss})
end