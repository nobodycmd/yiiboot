


echo '查找一个进程后将其杀掉，然后重新启动，此只是一个模版，请自己根据实际情况进行替换'


# ps -ef |grep binprogramname |awk '{print $2}'|xargs kill -9

# nohup binprogram>/dev/null 2>&1 &
