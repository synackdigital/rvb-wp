require "rake"
require "sprockets"
require 'closure-compiler'

def self.sprocketize(path, source, destination = nil, strip_comments = true)
  root_dir = File.expand_path(File.dirname(__FILE__))
  src_dir = File.join(root_dir, 'src')
  dist_dir = File.join(root_dir, 'js')
  secretary = Sprockets::Secretary.new(
    :root           => File.join(root_dir, path),
    :load_path      => [src_dir],
    :source_files   => [source],
    :strip_comments => strip_comments
  )

  destination = File.join(dist_dir, source) unless destination
  secretary.concatenation.save_to(destination)
end

desc "Creates a distribution javascript file"
task :dist do
  sprocketize("src", "script.js")
  'growlnotify -m "Rake dist complete"'
end

desc "Compiles the distribution javascript"
task :compile => [:dist] do
  root_dir = File.expand_path(File.dirname(__FILE__))
  script_file = File.join(root_dir, "js/script.js")
  compiled = Closure::Compiler.new.compile(File.open(script_file, "r"))
  File.unlink(script_file) if File.exist?(script_file)
  f = File.new(script_file, "w")
  f.write(compiled)
  f.close()
end

task :default => [:compile]