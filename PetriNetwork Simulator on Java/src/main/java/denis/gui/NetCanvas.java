package denis.gui;

import denis.generation.*;

import java.awt.*;
import java.awt.geom.Line2D;
import java.awt.geom.Rectangle2D;
import java.util.ArrayList;
import java.lang.Object;

public class NetCanvas extends Canvas {
    private PetriNetwork net;
    private ArrayList<Shape> shapes = new ArrayList<>();

    public NetCanvas(Dimension d) {
        this.setSize(d);
    }

    public PetriNetwork getNet() {
        return net;
    }

    public void setNet(PetriNetwork net) {
        this.net = net;
    }

    @Override
    public void paint(Graphics g2) {
        Graphics2D g = (Graphics2D) g2;
        g.setStroke(new BasicStroke(2));
        g.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
        g.setRenderingHint(RenderingHints.KEY_RENDERING, RenderingHints.VALUE_RENDER_QUALITY);
        if (this.net != null) {
            this.net.checkAllTransitions();
            for (Arcs a : net.getArcs()) {
                for (Place p : net.getPlaces()) {
                    if (p.getId() == a.getSourceId()) {
                        for (Transition t : net.getTransitions()) {
                            if (t.getId() == a.getDestinationId()) {
                                drawArrow(g, new Point(p.getX() + 12, p.getY() + 12), new Point(t.getX(), t.getY() + 12));
                                a.setRemoveDrawableArc(new Rectangle2D.Float(avarage(p.getX()+12, t.getX())-15, avarage(p.getY()+12, t.getY()+12)-10, 30, 20));
                                g.setColor(new Color(0,0,0,0f));
                                g.draw(a.getRemoveDrawableArc());
                                g.setColor(Color.BLACK);
                            }
                        }
                    }
                    if (p.getId() == a.getDestinationId()) {
                        for (Transition t : net.getTransitions()) {
                            if (t.getId() == a.getSourceId()) {
                                drawArrow(g, new Point(t.getX() + 12, t.getY() + 12), new Point(p.getX(), p.getY() + 12));
                                a.setRemoveDrawableArc(new Rectangle2D.Float(avarage(p.getX()+12, t.getX())-15, avarage(p.getY()+12, t.getY()+12)-10, 30, 20));
                                g.setColor(new Color(0,0,0,0f));
                                g.draw(a.getRemoveDrawableArc());
                                g.setColor(Color.BLACK);
                            }
                        }
                    }
                }
            }

            for (ResetArcs ra : net.getResetArcs()) {
                int srcX = net.getPlace(ra.getSourceId()).getX() + 12;
                int srcY = net.getPlace(ra.getSourceId()).getY() + 12;
                int dstX = net.getTransition(ra.getDestinationId()).getX();
                int dstY = net.getTransition(ra.getDestinationId()).getY() + 12;
                drawDoubleArrow(g, new Point(srcX, srcY), new Point(dstX, dstY));
            }

            drawPlace(g);

            for (Transition t : net.getTransitions()) {
                if (t.isRunnable()) {
                    g.setColor(Color.GREEN);
                    g.fillRect(t.getX(), t.getY(), 24, 24);
                    g.setColor(Color.BLACK);
                    g.drawRect(t.getX(), t.getY(), 24, 24);
                } else {
                    g.setColor(Color.RED);
                    g.fillRect(t.getX(), t.getY(), 24, 24);
                    g.setColor(Color.BLACK);
                    g.drawRect(t.getX(), t.getY(), 24, 24);
                }
            }
        }
    }

    public float avarage(float x, float x1){
        return (x+x1)/2;
    }

    public void drawArrow(Graphics2D g2d, Point start, Point end) {
        g2d.draw(new Line2D.Double(start, end));
        drawArrowHead(g2d, end, start, Color.black);
    }

    public void drawDoubleArrow(Graphics2D g2d, Point start, Point end) {
        g2d.draw(new Line2D.Double(start, end));
        drawArrowHead(g2d, end, start, Color.black);
        Point second_start = new Point(start.x, start.y);
        int new_x = (end.x + start.x) / 2;
        int new_y = (end.y + start.y) / 2;
        for (int i = 0; i < 3; i++) {
            new_x = (end.x + new_x) / 2;
            new_y = (end.y + new_y) / 2;
        }
        Point second_end = new Point(new_x, new_y);
        drawArrowHead(g2d, second_end, second_start, Color.black);
    }

    public void drawPlace(Graphics2D graphics2D){
        for (Place p : net.getPlaces()) {
            graphics2D.setColor(Color.WHITE);
            graphics2D.fillOval(p.getX(), p.getY(), 24, 24);
            graphics2D.setColor(Color.BLACK);
            graphics2D.drawOval(p.getX(), p.getY(), 24, 24);
            graphics2D.drawString(Integer.toString(p.getTokens()), p.getX() + 8, p.getY() + 16);
        }
    }



    public void drawArrowHead(Graphics2D g2, Point tip, Point tail, Color color) {
        double phi;
        int barb;
        phi = Math.toRadians(20);
        barb = 20;
        g2.setPaint(color);
        double dy = tip.y - tail.y;
        double dx = tip.x - tail.x;
        double theta = Math.atan2(dy, dx);

        //System.out.println("theta = " + Math.toDegrees(theta));
        double x, y, rho = theta + phi;
        Polygon p = new Polygon();
        p.addPoint(tip.x, tip.y);

        for (int j = 0; j < 2; j++) {
            x = tip.x - barb * Math.cos(rho);
            y = tip.y - barb * Math.sin(rho);
            p.addPoint((int) x, (int) y);
            rho = theta - phi;
        }
        g2.fill(p);
    }
}
