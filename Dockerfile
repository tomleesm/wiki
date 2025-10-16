FROM node:latest
WORKDIR /app
VOLUME /app/content
EXPOSE 8080
RUN git clone https://github.com/jackyzha0/quartz.git tmp
RUN cd tmp && rm -rf content && mv -f * ../ && cd .. && rm -rf tmp
RUN npm ci
CMD ["npx", "quartz", "build", "--serve"]
