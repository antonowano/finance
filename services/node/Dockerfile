FROM node:latest

RUN npm install -g serve

WORKDIR /home/app

COPY . .
RUN rm -rf node_modules \
    && npm install --production \
    && npm run build

EXPOSE 5000

CMD ["serve", "-s", "build"]
