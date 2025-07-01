<?php
session_start();

// Full question bank (30 questions)
$questionBank = [
  ["question" => "What should you do if you're being followed?", "options" => ["Confront them", "Take a shortcut", "Go to a crowded place", "Ignore them"], "answer" => "Go to a crowded place"],
  ["question" => "Who should you call in an emergency?", "options" => ["Your friend", "Emergency helpline", "Online support", "Delivery guy"], "answer" => "Emergency helpline"],
  ["question" => "Which is a useful self-defense item?", "options" => ["Lipstick", "Pepper spray", "Perfume", "Water bottle"], "answer" => "Pepper spray"],
  ["question" => "What’s a good safety habit when walking alone at night?", "options" => ["Talk loudly on phone", "Avoid isolated areas", "Text and walk", "Listen to music"], "answer" => "Avoid isolated areas"],
  ["question" => "How can friends track you safely?", "options" => ["Tell no one", "Share live location", "Switch off phone", "Avoid telling anyone"], "answer" => "Share live location"],
  ["question" => "What to do immediately if harassed?", "options" => ["Stay silent", "Run", "Call police", "Ignore"], "answer" => "Call police"],
  ["question" => "What’s safer at night?", "options" => ["Walking alone", "Public bus", "Trusted ride service", "Stranger's car"], "answer" => "Trusted ride service"],
  ["question" => "What’s essential in emergency contact list?", "options" => ["App support", "Emergency contacts", "Delivery contacts", "No one"], "answer" => "Emergency contacts"],
  ["question" => "How should one handle persistent stalkers?", "options" => ["Ignore", "Accept them", "Report", "Stalk back"], "answer" => "Report"],
  ["question" => "Best proactive safety step?", "options" => ["Create a safety plan", "Avoid planning", "Stay online", "Rely on others"], "answer" => "Create a safety plan"],
  ["question" => "What to avoid on social media?", "options" => ["Friends only", "Sharing location publicly", "Private posts", "Security settings"], "answer" => "Sharing location publicly"],
  ["question" => "What should you do when threatened in public?", "options" => ["Shout", "Hide", "Stay quiet", "Wait"], "answer" => "Shout"],
  ["question" => "Which is a defensive move?", "options" => ["Stand still", "Scream", "Step back", "Use whistle"], "answer" => "Use whistle"],
  ["question" => "Best way to carry valuables?", "options" => ["Visible bags", "Hidden pouch", "Pocket", "Hand"], "answer" => "Hidden pouch"],
  ["question" => "When should you avoid rides?", "options" => ["Late night", "Unknown driver", "Solo ride", "All above"], "answer" => "All above"],
  ["question" => "What is SOS?", "options" => ["Safe Operating System", "Signal of Security", "Emergency alert", "Slow on street"], "answer" => "Emergency alert"],
  ["question" => "Use of personal alarms?", "options" => ["Noise alert", "Flashlight", "Self-defense", "Fake call"], "answer" => "Noise alert"],
  ["question" => "What does self-defense mean?", "options" => ["Fighting", "Protection", "Yelling", "Running"], "answer" => "Protection"],
  ["question" => "Best safety app use?", "options" => ["Location tracking", "Texting", "Calling", "None"], "answer" => "Location tracking"],
  ["question" => "Safe password habit?", "options" => ["Share with friends", "Use name", "Strong, private", "Use same password"], "answer" => "Strong, private"],
  ["question" => "What is cyberstalking?", "options" => ["Messaging", "Following online", "Commenting", "Sharing"], "answer" => "Following online"],
  ["question" => "Safety in elevators?", "options" => ["Ride with strangers", "Stay alert", "Use phone", "Look away"], "answer" => "Stay alert"],
  ["question" => "Best action in danger?", "options" => ["Freeze", "Call helpline", "Run blindly", "Panic"], "answer" => "Call helpline"],
  ["question" => "Avoid danger by?", "options" => ["Ignoring signs", "Being alert", "Hiding info", "None"], "answer" => "Being alert"],
  ["question" => "Proper way to refuse?", "options" => ["Say no firmly", "Smile", "Run", "Ignore"], "answer" => "Say no firmly"],
  ["question" => "Helpful item in bag?", "options" => ["Makeup", "Pepper spray", "Food", "Money"], "answer" => "Pepper spray"],
  ["question" => "When to call for help?", "options" => ["If feeling unsafe", "Only if hurt", "Never", "Later"], "answer" => "If feeling unsafe"],
  ["question" => "Who can help?", "options" => ["Police", "Friend", "Family", "All of these"], "answer" => "All of these"],
  ["question" => "Best app alert feature?", "options" => ["Battery saver", "SOS alert", "Games", "Reminders"], "answer" => "SOS alert"],
  ["question" => "Use of flashlight?", "options" => ["Blind attacker", "Navigate safely", "Take selfies", "Signal help"], "answer" => "Signal help"]
];

if (!isset($_SESSION['quiz_questions']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
  shuffle($questionBank);
  $_SESSION['quiz_questions'] = array_slice($questionBank, 0, 8);
}

$quizQuestions = $_SESSION['quiz_questions'] ?? [];
$submitted = false;
$score = 0;
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $submitted = true;
  foreach ($quizQuestions as $index => $q) {
    $qid = "q" . $index;
    $userAnswer = $_POST[$qid] ?? '';
    $correctAnswer = $q['answer'];
    $results[] = [
      'question' => $q['question'],
      'user' => $userAnswer,
      'correct' => $correctAnswer,
      'isCorrect' => $userAnswer === $correctAnswer
    ];
    if ($userAnswer === $correctAnswer) $score++;
  }
  unset($_SESSION['quiz_questions']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DropGuard Awareness Quiz</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('images/women.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0; padding: 20px;
      color: #333;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: rgba(255,255,255,0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    h1 {
      color: #8e24aa;
      text-align: center;
    }
    .question {
      margin-bottom: 20px;
    }
    .options label {
      display: block;
      padding: 6px 10px;
      margin: 6px 0;
      border-radius: 6px;
      background: #f5f5f5;
      cursor: pointer;
      transition: 0.2s;
    }
    .options label:hover {
      background: #e1bee7;
    }
    .btn-submit {
      display: block;
      margin: 30px auto;
      background: #8e24aa;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }
    .result {
      margin-top: 20px;
      background: #e0f7fa;
      padding: 15px;
      border-radius: 10px;
    }
    .correct { color: green; }
    .wrong { color: red; }
    .encourage {
      font-size: 18px;
      text-align: center;
      margin-top: 25px;
      color: #4a148c;
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Awareness Quiz</h1>

  <?php if (!$submitted): ?>
  <form method="post">
    <?php foreach ($quizQuestions as $index => $q): ?>
      <div class="question">
        <strong>Q<?= $index+1 ?>: <?= htmlspecialchars($q['question']) ?></strong>
        <div class="options">
          <?php foreach ($q['options'] as $option): ?>
            <label>
              <input type="radio" name="q<?= $index ?>" value="<?= htmlspecialchars($option) ?>" required>
              <?= htmlspecialchars($option) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <button class="btn-submit" type="submit">Submit</button>
  </form>
  <?php else: ?>
    <div class="result">
      <h2>Your Score: <?= $score ?>/<?= count($results) ?></h2>
      <?php foreach ($results as $res): ?>
        <p>
          <strong><?= htmlspecialchars($res['question']) ?></strong><br>
          Your answer: <span class="<?= $res['isCorrect'] ? 'correct' : 'wrong' ?>"><?= htmlspecialchars($res['user']) ?></span><br>
          Correct answer: <?= htmlspecialchars($res['correct']) ?>
        </p>
      <?php endforeach; ?>
    </div>
    <div class="encourage">
      <?= $score >= 6 ? "🎉 Great job! You're well aware." : "📘 Keep learning. Safety matters!" ?>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
