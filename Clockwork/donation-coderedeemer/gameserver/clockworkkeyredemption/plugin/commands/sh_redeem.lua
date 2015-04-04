local COMMAND = Clockwork.command:New("redeem");
COMMAND.tip = "Redeem a donation code.";

-- Called when the command has been run.
function COMMAND:OnRun(player)
	 player:ConCommand("enterdonationkey");
end;

COMMAND:Register();
