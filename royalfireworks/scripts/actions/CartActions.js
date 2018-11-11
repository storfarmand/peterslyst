import dispatcher from '../dispatcher';

export function bgToggle(data) {
  dispatcher.dispatch({
    type: "CART",
    action: "BGTOGGLE"
  });
}
