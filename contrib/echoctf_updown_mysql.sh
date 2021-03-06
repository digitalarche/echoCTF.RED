#!/bin/ksh
MEMD="{{db.host}}"
DBHOST="127.0.0.1"
DBUSER="{{db.user}}"
DBPASS="{{db.pass}}"
NCOPTS="-N"
# Stop users from connecting when the event is not active
#EVENT_ACTIVE=$(echo "get sysconfig:event_active"|nc -N ${MEMD} 11211 |egrep -v "(VALUE|END)")
#if [ "$EVENT_ACTIVE" == "0" ] || [ "$EVENT_ACTIVE" == "" ]; then
#  exit 2
#fi


echo "------------" >>/tmp/updown.log
date >> /tmp/updown.log

if [ "$script_type" == "client-connect" ]; then
    echo "client connect $common_name" >> /tmp/updown.log
    USER_LOGGEDIN=$(echo "get ovpn:$common_name"|nc ${NCOPTS} ${MEMD} 11211 |egrep -v "(VALUE|END)")
    echo "USER_LOGGEDIN: $USER_LOGGEDIN" >>/tmp/updown.log
    if [ "$USER_LOGGEDIN" == "" ]; then
      echo "[$$] logging in client ${common_name}" >>/tmp/updown.log
      mysql -h ${DBHOST} -u"${DBUSER}" -p"${DBPASS}" echoCTF -e "CALL VPN_LOGIN(${common_name},INET_ATON('${ifconfig_pool_remote_ip}'),INET_ATON('${untrusted_ip}'))"
      echo "[$$] client ${common_name} logged in successfully">>/tmp/updown.log
    else
      echo "[$$] client ${common_name} already logged in">>/tmp/updown.log
      exit 1
    fi
elif [ "$script_type" == "client-disconnect" ]; then
  mysql -h ${DBHOST} -u"${DBUSER}" -p"${DBPASS}" -e "CALL VPN_LOGOUT(${common_name},INET_ATON('${ifconfig_pool_remote_ip}'),INET_ATON('${untrusted_ip}'))" echoCTF
  echo "[$$] client cn:${common_name}, local:${ifconfig_pool_remote_ip}, remote: ${untrusted_ip} disconnected successfully">>/tmp/updown.log
fi

exit 0
