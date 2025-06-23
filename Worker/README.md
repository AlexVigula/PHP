$ ./beanstalkd -l 10.0.1.5 -p 11300

beanstalk = Beanstalk::Pool.new(['10.0.1.5:11300'])
beanstalk.put('hello')

beanstalk = Beanstalk::Pool.new(['10.0.1.5:11300'])
loop do
  job = beanstalk.reserve
  puts job.body # prints "hello"
  job.delete
end
