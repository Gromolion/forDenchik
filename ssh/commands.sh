sudo apt-get install openssh-server
sudo cp /etc/ssh/sshd_config /etc/ssh/sshd_config.original
sudo chmod a-w /etc/ssh/sshd_config.original
ip a
ssh 10.0.2.15
sudo nano /etc/ssh/sshd_config
sudo systemctl restart sshd
ssh 10.0.2.15 -p 2222
ssh-keygen -t rsa
ssh-copy-id -i ~/.ssh/id_rsa.pub 10.0.2.15 -p 2222