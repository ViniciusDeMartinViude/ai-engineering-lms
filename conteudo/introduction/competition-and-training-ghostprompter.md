[Slide 1 | AI Engineering]
// Start the recording with the title slide on screen. Look into the camera.

Welcome to AI Engineering Foundations and Competition Practice. I’m Vinicius, and I’ll be your trainer as you prepare for the Emirates Skills National Competition.

Here’s a question we’ll come back to throughout training. When your program gives you an answer, how do you decide whether to trust it?

Sometimes the answer will be a prediction about tomorrow’s electricity use. Sometimes it will be the position of an object that a robot is about to pick up. In each case, you’ll need a way to check your work.

Let’s start with what you can expect at the competition.

// Advance PowerPoint to slide 2.

---

[Slide 2 | The competition]
// Point to “18 hours”. Then bring attention to the two challenges on the right.

You’ll have eighteen hours of competition time in total. That’s three days, with six working hours each day.

You’ll work on a camera-and-robot application. You’ll also receive a surprise dataset and a brief explaining what you need to do with it.

When you get the brief, read the submission instructions before you start coding. What do you need to hand in? How will you check that it works? Aim to get a simple version running early enough to test it. We’ll practise doing that under time pressure before the competition.

Let’s take a closer look at the camera application.

// Advance PowerPoint to slide 3.

---

[Slide 3 | The camera-and-robot application]
// Point to the stereo cameras, then trace the path of one object along the conveyor.

Imagine one object travelling along this conveyor. Two cameras observe it from slightly different positions. Your application uses those views to recognise the object and estimate where it is and how high it sits. The robot needs that information to handle it.

Now imagine the object appears in three consecutive frames. Your detector might correctly draw a box around it three times. How many times should the robot try to pick it up?

// Pause for an answer.

Once. So a good detection in each frame still leaves you with an engineering problem. How will your software recognise that it’s looking at the same physical object? And what would you record to check that it issued only one command?

In training, we can replay a short clip, follow one object and compare what we saw with the application’s log.

// Advance PowerPoint to slide 4.

---

[Slide 4 | The surprise dataset]
// Let students read the question on screen.

Now picture opening the surprise dataset for the first time. What would you look at first?

// Pause.

I’d start with the brief and a handful of actual examples. What does one example represent? A photograph? A reading from one sensor at one moment? A whole conversation? For a conversation, two messages might belong together. For a video, adjacent frames might show the same event. That matters when you decide which examples to keep for testing.

The early lessons give you tools you can carry into any unfamiliar dataset. You’ll use Python notebooks to inspect records and plot measurements. You’ll learn to ask what the model can know when it makes a prediction. And you’ll practise building a simple baseline so you have something to compare your first model against.

Let me show you how the question itself can change your approach.

// Advance PowerPoint to slide 5.

---

[Slide 5 | A school’s electricity records]
// Start with the forecast on the left. Give students a moment before revealing your example aloud.

Suppose I give you a school’s electricity readings and ask how much energy the building will use tomorrow. What’s the simplest forecast you could try?

One answer is to use today’s reading. If the school used eight hundred kilowatt-hours today, predict eight hundred for tomorrow. Repeat that on earlier days, then compare each forecast with the reading that followed it. Now you know how well a very simple approach performs.

// Shift attention to “Find patterns” on the right.

Keep the same records, but change my question. Which days had similar patterns of electricity use? Now you might compare morning and afternoon readings, group similar days, and inspect a few dates in each group. Do school days and holidays fall together? Look at the dates before you decide.

That’s why we’ll work with tables, text and images. When the surprise dataset arrives, you can start by deciding what question the data needs to answer.

// Advance PowerPoint to slide 6.

---

[Slide 6 | How training works in Moodle]
// Follow the three stages on screen.

In Moodle, start each lesson with the recorded demonstration and the reading. When I ask you to predict a result, pause and write down what you expect. It gives you something specific to check when you run the experiment.

Next, open the practical exercise. In a notebook, run the original example first. Then change one condition and keep both results. If a change makes performance worse, save that result too. It may tell us more than the best run.

Before submitting, read the assignment criteria. One task might ask for a graph and a short explanation. Another might ask for a log showing what happened when a camera stream stopped. After I review your work, open the feedback and use it to choose your next test.

If you’d like to work through a result with me, here’s how to arrange that.

// Advance PowerPoint to slide 7.

---

[Slide 7 | One-to-one meetings]
// Keep the QR code fully visible. The booking address below is a presenter reference.
// https://bookings.cloud.microsoft/bookwithme/user/42c43faa3cda4360a80d51ba7731238f@aths.ac.ae/meetingtype/xCup8QmIv0S8j4AjB69p6g2?anonymous&ismsaljsauthenabled&ep=mlink

You can book a one-to-one online meeting with me during training. Scan the QR code on this slide, or select “Open the booking page” if you’re viewing the presentation on your computer. In Moodle, look for “Book an office hour.”

Choose an available slot in Microsoft Bookings, check the time zone shown, enter your details and confirm. If you’re watching the recording, pause here while you book.

// Hold the slide for a few seconds.

Bring one question and one example. You could say, “My detector counted this object twice. Here are the two frames and their timestamps. Can we work out why?” That gives us a place to begin. You’re equally welcome to bring an idea you’d like to try.

// Advance PowerPoint to slide 8.

---

[Slide 8 | Lesson 1.1: How machines learn]
// Point to the photograph. Give students time to look.

Before we finish, take a look at this flower. Pick one detail you can point to. It could be the edge of a petal, or a place where the light fades into shadow.

Imagine you could redraw the entire photograph using only two colours. Which detail do you think would disappear first?

// Pause.

Open Lesson One in Moodle and write down your prediction before you run the notebook. Then you’ll be able to compare what you expected with what the model actually produced.

I’ll see you in the lab.
