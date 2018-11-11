import dispatcher from '../dispatcher';

export function bgToggle(data) {
  dispatcher.dispatch({
    type: "PRODUCT",
    action: "BGTOGGLE"
  });
}
