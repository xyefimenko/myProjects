package denis.generation;



public class Transition extends Apex{
    private boolean runnable = false;

    public Transition(String name){
        super(name);
    }

    public Transition(String name, long id){
        super(name, id);
    }


    public boolean isRunnable() {
        return runnable;
    }

    public void setRunnable(boolean runnable) {
        this.runnable = runnable;
    }
}
