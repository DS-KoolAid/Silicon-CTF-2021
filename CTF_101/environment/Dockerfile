FROM ubuntu:16.04

RUN apt-get update && apt-get install -y openssh-server
RUN mkdir /var/run/sshd

# Set up Chroot Jail
RUN mkdir -p /var/jail/
RUN mkdir -p /var/jail/dev/		
WORKDIR /var/jail/dev/
RUN mknod -m 666 null c 1 3
RUN mknod -m 666 tty c 5 0
RUN mknod -m 666 zero c 1 5
RUN mknod -m 666 random c 1 8
WORKDIR /root/
RUN chown root:root /var/jail
RUN chmod 0755 /var/jail
RUN mkdir -p /var/jail/lib/x86_64-linux-gnu
RUN mkdir -p /var/jail/lib64
RUN mkdir -p /var/jail/usr/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libtinfo.so.5 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libdl.so.2 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libc.so.6 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libm.so.6 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libselinux.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libacl.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libpthread.so.0 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libpcre.so.3 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libattr.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libexpat.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libz.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib/x86_64-linux-gnu/libutil.so.1 /var/jail/lib/x86_64-linux-gnu/
RUN cp -v /lib64/ld-linux-x86-64.so.2 /var/jail/lib64/
RUN mkdir /var/jail/etc
RUN adduser trooper
RUN cat /etc/passwd | grep trooper >> /var/jail/etc/passwd
COPY sshd_chroot /root/sshd_chroot
RUN cat sshd_chroot >> /etc/ssh/sshd_config
RUN rm /root/sshd_chroot

# Provide the following commands
RUN mkdir -p /var/jail/bin
RUN mkdir -p /var/jail/usr/bin
RUN cp -v /bin/bash /var/jail/bin/
RUN cp -v /bin/ls /var/jail/bin
RUN cp -v /usr/bin/cd /var/jail/usr/bin
RUN cp -v /usr/bin/env /var/jail/usr/bin


# Set up SSH Key
RUN mkdir /home/trooper/.ssh
RUN chown -R trooper: /home/trooper/.ssh
COPY silicon_ctf_env.pub /home/trooper/.ssh/authorized_keys

# Add challenge files
RUN mkdir -p /var/jail/home/trooper
COPY profile /var/jail/home/trooper/.profile
WORKDIR /var/jail/home/trooper

ENV FLAG flag{3nv1R0nm3nt_v4R5_aR3_k00L}

EXPOSE 22
CMD ["/usr/sbin/sshd", "-D"]