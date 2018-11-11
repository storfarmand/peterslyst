import { EventEmitter } from "events";

import dispatcher from '../dispatcher';

class CartStore extends EventEmitter {
  constructor() {
    super();
  }
  handleBgToggle() {
    this.emit('cart:bgtoggle');
  }
  handleActions(evt) {
    switch(evt.type) {
      case "CART":
        switch (evt.action) {
          case "BGTOGGLE":
            this.handleBgToggle();
            break;
        }
    }
  }

}

const cartStore = new CartStore;
dispatcher.register(cartStore.handleActions.bind(cartStore));

export default cartStore;
