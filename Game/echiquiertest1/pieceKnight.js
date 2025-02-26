import { pieceParent } from "./pieceParent.js";

export class pieceKnight extends pieceParent {
    sprite = "white-knight.png";
    range=1;


    setmovement() {
        //super();
        super.setmovement();
        this.movementKnight()
    }
}