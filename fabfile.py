from fabric import *

admin.hosts=['www.ingresso-art.com']
admin.user='our-user'

repository = 'https://github.com/lucianalml/ingresso.git'
folder = '/var/www/html/ingressos'

def commitChange(msg='default')
        local('git add .')
        local('git add -u .')
        local('git pull')
        local('git commit -am %s',msg)
        local('git push')

def start_test():
        pass

def deploy(msg='stage'):
        if msg=='stage':
                commitChange()
                send_to_slack()
                send_update()
                start_test()
        elif msg=="production"
                pass

def commitChange(msg='default')
        local('git add .')
        local('git add -u .')
        local('git pull')
        local('git commit -am %s',msg)
        local('git push')

def send_to_slack(usr,msg,chanel,emoji):
        curl_msg="""curl -H "Content-Type: application/json" -X POST -d '{"channel":"spy","username":"INGRESSITO","text":"Nosso primeiro hook","icon_emoji":":pill:"}' https://hooks.slack.com/services/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"""
        local(curl_msg)

def deploy(msg='stage'):
        if msg=='stage':
                commitChange()
                send_to_slac()
