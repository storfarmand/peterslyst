import { EventEmitter } from "events";

import dispatcher from '../dispatcher';

class ProductStore extends EventEmitter {
  constructor() {
    super();
  }
  handleBgToggle() {
    this.emit('product:bgtoggle');
  }
  handleActions(evt) {
    switch(evt.type) {
      case "PRODUCT":
        switch (evt.action) {
          case "BGTOGGLE":
            this.handleBgToggle();
            break;
        }
    }
  }

}

const productStore = new ProductStore;
dispatcher.register(productStore.handleActions.bind(productStore));

export default productStore;
