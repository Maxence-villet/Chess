import { pieceParent } from "./pieceParent.js";

export class pieceBishop extends pieceParent {
    sprite = "white-bishop.png";

    setmovement() {
        super.setmovement();
        this.movementBishop();
    }
}