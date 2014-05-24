local FACTION = Clockwork.faction:New("Incognito");
local PLUGIN = PLUGIN;
FACTION.useFullName = true;
FACTION.whitelist = true;
FACTION.material = "halfliferp/factions/citizen";

-- Called when a player is transferred to the faction.
function FACTION:OnTransferred(player, faction, name)
	if (Schema:PlayerIsCombine(player)) then
		if (name) then
			local models = self.models[ string.lower( player:QueryCharacter("gender") ) ];
			
			if (models) then
				player:SetCharacterData("model", models[ math.random(#models) ], true);
				
				Clockwork.player:SetName(player, name, true);
			end;
		else
			return false, "You need to specify a name as the third argument!";
		end;
	end;
end;

-- Called when a player's scoreboard class is needed.
function PLUGIN:GetPlayerScoreboardClass(player)
 local faction1 = player:GetFaction();
 local clientfaction = Clockwork.Client:GetFaction();
  if (faction1 == FACTION_INCOG) then
  if (Clockwork.Client:GetFaction() == FACTION_INCOG) then
   return "Incognito faction"; -- Edit this part for the name on the scoreboard.
  elseif (Clockwork.Client:IsAdmin()) then
   return "Hidden Faction(ADMIN/OOC View)";
  else
   return false;
  end;
 end;
end;
 
FACTION_INCOG = FACTION:Register();